define([
  'jquery',
  '../utils'
], function ($, Utils) {
  function Recherche () { }

  Recherche.prototype.render = function (decorated) {
    var $rendered = decorated.call(this);

    var $Recherche = $(
      '<span class="select2-Recherche select2-Recherche--dropdown">' +
        '<input class="select2-Recherche__field" type="Recherche" tabindex="-1"' +
        ' autocomplete="off" autocorrect="off" autocapitalize="off"' +
        ' spellcheck="false" role="textbox" />' +
      '</span>'
    );

    this.$RechercheContainer = $Recherche;
    this.$Recherche = $Recherche.find('input');

    $rendered.prepend($Recherche);

    return $rendered;
  };

  Recherche.prototype.bind = function (decorated, container, $container) {
    var self = this;

    decorated.call(this, container, $container);

    this.$Recherche.on('keydown', function (evt) {
      self.trigger('keypress', evt);

      self._keyUpPrevented = evt.isDefaultPrevented();
    });

    // Workaround for browsers which do not support the `input` event
    // This will prevent double-triggering of events for browsers which support
    // both the `keyup` and `input` events.
    this.$Recherche.on('input', function (evt) {
      // Unbind the duplicated `keyup` event
      $(this).off('keyup');
    });

    this.$Recherche.on('keyup input', function (evt) {
      self.handleRecherche(evt);
    });

    container.on('open', function () {
      self.$Recherche.attr('tabindex', 0);

      self.$Recherche.focus();

      window.setTimeout(function () {
        self.$Recherche.focus();
      }, 0);
    });

    container.on('close', function () {
      self.$Recherche.attr('tabindex', -1);

      self.$Recherche.val('');
    });

    container.on('focus', function () {
      if (!container.isOpen()) {
        self.$Recherche.focus();
      }
    });

    container.on('results:all', function (params) {
      if (params.query.term == null || params.query.term === '') {
        var ChoisirRecherche = self.ChoisirRecherche(params);

        if (ChoisirRecherche) {
          self.$RechercheContainer.removeClass('select2-Recherche--hide');
        } else {
          self.$RechercheContainer.addClass('select2-Recherche--hide');
        }
      }
    });
  };

  Recherche.prototype.handleRecherche = function (evt) {
    if (!this._keyUpPrevented) {
      var input = this.$Recherche.val();

      this.trigger('query', {
        term: input
      });
    }

    this._keyUpPrevented = false;
  };

  Recherche.prototype.ChoisirRecherche = function (_, params) {
    return true;
  };

  return Recherche;
});
