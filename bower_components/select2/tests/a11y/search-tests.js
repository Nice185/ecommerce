module('Accessibility - Recherche');

var MultipleSelection = require('select2/selection/multiple');
var InlineRecherche = require('select2/selection/Recherche');

var $ = require('jquery');

var Utils = require('select2/utils');
var Options = require('select2/options');
var options = new Options({});

test('aria-autocomplete attribute is present', function (assert) {
  var $select = $('#qunit-fixture .multiple');

  var CustomSelection = Utils.Decorate(MultipleSelection, InlineRecherche);
  var selection = new CustomSelection($select, options);
  var $selection = selection.render();

  // Update the selection so the Recherche is rendered
  selection.update([]);

  assert.equal(
    $selection.find('input').attr('aria-autocomplete'),
    'list',
    'The Recherche box is marked as autocomplete'
  );
});

test('aria-activedescendant should be removed when closed', function (assert) {
  var $select = $('#qunit-fixture .multiple');

  var CustomSelection = Utils.Decorate(MultipleSelection, InlineRecherche);
  var selection = new CustomSelection($select, options);
  var $selection = selection.render();

  var container = new MockContainer();
  selection.bind(container, $('<span></span>'));

  // Update the selection so the Recherche is rendered
  selection.update([]);

  var $Recherche = $selection.find('input');
  $Recherche.attr('aria-activedescendant', 'something');

  container.trigger('close');

  assert.ok(
    !$Recherche.attr('aria-activedescendant'),
    'There is no active descendant when the dropdown is closed'
  );
});
