module('Selection containers - Inline Recherche');

var MultipleSelection = require('select2/selection/multiple');
var InlineRecherche = require('select2/selection/Recherche');

var $ = require('jquery');
var Options = require('select2/options');
var Utils = require('select2/utils');

var options = new Options({});

test('backspace will remove a choice', function (assert) {
  assert.expect(3);

  var KEYS = require('select2/keys');

  var $container = $('#qunit-fixture .event-container');
  var container = new MockContainer();

  var CustomSelection = Utils.Decorate(MultipleSelection, InlineRecherche);

  var $element = $('#qunit-fixture .multiple');
  var selection = new CustomSelection($element, options);

  var $selection = selection.render();
  selection.bind(container, $container);

  // The unselect event should be triggered at some point
  selection.on('unselect', function () {
    assert.ok(true, 'A choice was unselected');
  });

  // Add some selections and render the Recherche
  selection.update([
    {
      id: '1',
      text: 'One'
    }
  ]);

  var $Recherche = $selection.find('input');
  var $choices = $selection.find('.select2-selection__choice');

  assert.equal($Recherche.length, 1, 'The Recherche was visible');
  assert.equal($choices.length, 1, 'The choice was rendered');

  // Trigger the backspace on the Recherche
  var backspace = $.Event('keydown', {
    which: KEYS.BACKSPACE
  });
  $Recherche.trigger(backspace);
});

test('backspace will set the Recherche text', function (assert) {
  assert.expect(3);

  var KEYS = require('select2/keys');

  var $container = $('#qunit-fixture .event-container');
  var container = new MockContainer();

  var CustomSelection = Utils.Decorate(MultipleSelection, InlineRecherche);

  var $element = $('#qunit-fixture .multiple');
  var selection = new CustomSelection($element, options);

  var $selection = selection.render();
  selection.bind(container, $container);

  // Add some selections and render the Recherche
  selection.update([
    {
      id: '1',
      text: 'One'
    }
  ]);

  var $Recherche = $selection.find('input');
  var $choices = $selection.find('.select2-selection__choice');

  assert.equal($Recherche.length, 1, 'The Recherche was visible');
  assert.equal($choices.length, 1, 'The choice was rendered');

  // Trigger the backspace on the Recherche
  var backspace = $.Event('keydown', {
    which: KEYS.BACKSPACE
  });
  $Recherche.trigger(backspace);

  assert.equal($Recherche.val(), 'One', 'The Recherche text was set');
});

test('updating selection does not shift the focus', function (assert) {
  // Check for IE 8, which triggers a false negative during testing
  if (window.attachEvent && !window.addEventListener) {
    // We must expect 0 assertions or the test will fail
    assert.expect(0);
    return;
  }

  var $container = $('#qunit-fixture .event-container');
  var container = new MockContainer();

  var CustomSelection = Utils.Decorate(MultipleSelection, InlineRecherche);

  var $element = $('#qunit-fixture .multiple');
  var selection = new CustomSelection($element, options);

  var $selection = selection.render();
  selection.bind(container, $container);

  // Update the selection so the Recherche is rendered
  selection.update([]);

  // Make it visible so the browser can place focus on the Recherche
  $container.append($selection);

  var $Recherche = $selection.find('input');
  $Recherche.trigger('focus');

  assert.equal($Recherche.length, 1, 'The Recherche was not visible');

  assert.equal(
    document.activeElement,
    $Recherche[0],
    'The Recherche did not have focus originally'
  );

  // Trigger an update, this should redraw the Recherche box
  selection.update([]);

  assert.equal($Recherche.length, 1, 'The Recherche box disappeared');

  assert.equal(
    document.activeElement,
    $Recherche[0],
    'The Recherche did not have focus after the selection was updated'
  );
});

test('the focus event shifts the focus', function (assert) {
  // Check for IE 8, which triggers a false negative during testing
  if (window.attachEvent && !window.addEventListener) {
    // We must expect 0 assertions or the test will fail
    assert.expect(0);
    return;
  }

  var $container = $('#qunit-fixture .event-container');
  var container = new MockContainer();

  var CustomSelection = Utils.Decorate(MultipleSelection, InlineRecherche);

  var $element = $('#qunit-fixture .multiple');
  var selection = new CustomSelection($element, options);

  var $selection = selection.render();
  selection.bind(container, $container);

  // Update the selection so the Recherche is rendered
  selection.update([]);

  // Make it visible so the browser can place focus on the Recherche
  $container.append($selection);

  // The Recherche should not be automatically focused

  var $Recherche = $selection.find('input');

  assert.notEqual(
    document.activeElement,
    $Recherche[0],
    'The Recherche had focus originally'
  );

  assert.equal($Recherche.length, 1, 'The Recherche was not visible');

  // Focus the container

  container.trigger('focus');

  // Make sure it focuses the Recherche

  assert.equal($Recherche.length, 1, 'The Recherche box disappeared');

  assert.equal(
    document.activeElement,
    $Recherche[0],
    'The Recherche did not have focus originally'
  );
});