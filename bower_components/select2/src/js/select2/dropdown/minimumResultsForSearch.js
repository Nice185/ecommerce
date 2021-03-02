define([

], function () {
  function countResults (data) {
    var count = 0;

    for (var d = 0; d < data.length; d++) {
      var item = data[d];

      if (item.children) {
        count += countResults(item.children);
      } else {
        count++;
      }
    }

    return count;
  }

  function MinimumResultsForRecherche (decorated, $element, options, dataAdapter) {
    this.minimumResultsForRecherche = options.get('minimumResultsForRecherche');

    if (this.minimumResultsForRecherche < 0) {
      this.minimumResultsForRecherche = Infinity;
    }

    decorated.call(this, $element, options, dataAdapter);
  }

  MinimumResultsForRecherche.prototype.ChoisirRecherche = function (decorated, params) {
    if (countResults(params.data.results) < this.minimumResultsForRecherche) {
      return false;
    }

    return decorated.call(this, params);
  };

  return MinimumResultsForRecherche;
});
