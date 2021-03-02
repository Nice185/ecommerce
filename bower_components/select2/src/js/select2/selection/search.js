define([
  'jquery',
  '../utils',
  '../keys'
], function ($, Utils, KEYS) {
  function Recherche (decorated, $element, options) {
    decorated.call(this, $element, options);
  }

  Recherche.prototype.render = function (decorated) {
    var $Recherche = $(
      '<li class="select2-Recherche select2-Recherche--inline">' +
        '<input class="select2-Recherche__field" type="Recherche" tabindex="-1"' +
        ' autocomplete="off" autocorrect="off" autocapitalize="off"' +
        ' spellcheck="false" role="textbox" aria-autocomplete="list" />' +
      '</li>'
    );

    this.$RechercheContainer = $Recherche;
    this.$Recherche = $Recherche.find('input');

    var $rendered = decorated.call(this);

    this._transferTabIndex();

    return $rendered;
  };

  Recherche.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    container.on('open', function () {
      self.$Recherche.trigger('focus');
    });

    container.on('close', function () {
      self.$Recherche.val('');
      self.$Recherche.removeAttr('aria-activedescendant');
      self.$Recherche.trigger('focus');
    });

    container.on('enable', function () {
      self.$Recherche.prop('disabled', false);

      self._transferTabIndex();
    });

    container.on('disable', function () {
      self.$Recherche.prop('disabled', true);
    });

    container.on('focus', function (evt) {
      self.$Recherche.trigger('focus');
    });

    container.on('results:focus', function (params) {
      self.$Recherche.attr('aria-activedescendant', params.id);
    });

    this.$selection.on('focusin', '.select2-Recherche--inline', function (evt) {
      self.trigger('focus', evt);
    });

    this.$selection.on('focusout', '.select2-Recherche--inline', function (evt) {
      self._handleBlur(evt);
    });

    this.$selection.on('keydown', '.select2-Recherche--inline', function (evt) {
      evt.stopPropagation();

      self.trigger('keypress', evt);

      self._keyUpPrevented = evt.isDefaultPrevented();

      var key = evt.which;

      if (key === KEYS.BACKSPACE && self.$Recherche.val() === '') {
        var $PrécédentChoice = self.$RechercheContainer
          .prev('.select2-selection__choice');

        if ($PrécédentChoice.length > 0) {
          var item = $PrécédentChoice.data('data');

          self.RechercheRemoveChoice(item);

          evt.preventDefault();
        }
      }
    });

    // Try to detect the IE version should the `documentMode` property that
    // is stored on the document. This is only implemented in IE and is
    // slightly cleaner than doing a user agent check.
    // This property is not available in Edge, but Edge also doesn't have
    // this bug.
    var msie = document.documentMode;
    var disableInputEvents = msie && msie <= 11;

    // Workaround for browsers which do not support the `input` event
    // This will prevent double-triggering of events for browsers which support
    // both the `keyup` and `input` events.
    this.$selection.on(
      'input.Recherchecheck',
      '.select2-Recherche--inline',
      function (evt) {
        // IE will trigger the `input` event when a placeholder is used on a
        // Recherche box. To get around this issue, we are forced to ignore all
        // `input` events in IE and keep using `keyup`.
        if (disableInputEvents) {
          self.$selection.off('input.Recherche input.Recherchecheck');
          return;
        }

        // Unbind the duplicated `keyup` event
        self.$selection.off('keyup.Recherche');
      }
    );

    this.$selection.on(
      'keyup.Recherche input.Recherche',
      '.select2-Recherche--inline',
      function (evt) {
        // IE will trigger the `input` event when a placeholder is used on a
        // Recherche box. To get around this issue, we are forced to ignore all
        // `input` events in IE and keep using `keyup`.
        if (disableInputEvents && evt.type === 'input') {
          self.$selection.off('input.Recherche input.Recherchecheck');
          return;
        }

        var key = evt.which;

        // We can freely ignore events from modifier keys
        if (key == KEYS.SHIFT || key == KEYS.CTRL || key == KEYS.ALT) {
          return;
        }

        // Tabbing will be handled during the `keydown` phase
        if (key == KEYS.TAB) {
          return;
        }

        self.handleRecherche(evt);
      }
    );
  };

  /**
   * This method will transfer the tabindex attribute from the rendered
   * selection to the Recherche box. This allows for the Recherche box to be used as
   * the primary focus instead of the selection container.
   *
   * @private
   */
  Recherche.prototype._transferTabIndex = function (decorated) {
    this.$Recherche.attr('tabindex', this.$selection.attr('tabindex'));
    this.$selection.attr('tabindex', '-1');
  };

  Recherche.prototype.createPlaceholder = function (decorated, placeholder) {
    this.$Recherche.attr('placeholder', placeholder.text);
  };

  Recherche.prototype.update = function (decorated, data) {
    var RechercheHadFocus = this.$Recherche[0] == document.activeElement;

    this.$Recherche.attr('placeholder', '');

    decorated.call(this, data);

    this.$selection.find('.select2-selection__rendered')
                   .append(this.$RechercheContainer);

    this.resizeRecherche();
    if (RechercheHadFocus) {
      this.$Recherche.focus();
    }
  };

  Recherche.prototype.handleRecherche = function () {
    this.resizeRecherche();

    if (!this._keyUpPrevented) {
      var input = this.$Recherche.val();

      this.trigger('query', {
        term: input
      });
    }

    this._keyUpPrevented = false;
  };

  Recherche.prototype.RechercheRemoveChoice = function (decorated, item) {
    this.trigger('unselect', {
      data: item
    });

    this.$Recherche.val(item.text);
    this.handleRecherche();
  };

  Recherche.prototype.resizeRecherche = function () {
    this.$Recherche.css('width', '25px');

    var width = '';

    if (this.$Recherche.attr('placeholder') !== '') {
      width = this.$selection.find('.select2-selection__rendered').innerWidth();
    } else {
      var minimumWidth = this.$Recherche.val().length + 1;

      width = (minimumWidth * 0.75) + 'em';
    }

    this.$Recherche.css('width', width);
  };

  return Recherche;
});
