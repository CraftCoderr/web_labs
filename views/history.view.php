<?php include 'base.view.php' ?>

<?php startblock('content') ?>
<table class="history-table" id="session-hist">
    <tr>
        <th colspan="2">For current session</th>
    </tr>
    <tr>
        <th>Page</th>
        <th>Count</th>
    </tr>
</table>
<p></p>
<table class="history-table" id="global-hist">
    <tr>
        <th colspan="2">For all time</th>
    </tr>
    <tr>
        <th>Page</th>
        <th>Count</th>
    </tr>
</table>
<?php endblock() ?>

<?php startblock('scripts') ?>
<script>
  function showHistory(table, history) {
    for (var page in history) {
      var row = document.createElement('tr')
      var title = document.createElement('td')
      title.innerText = page
      var count = document.createElement('td')
      count.innerText = history[page]
      row.appendChild(title)
      row.appendChild(count)
      table.appendChild(row)
    }
  }

  var global = getGlobalHistory()
  var session = getSessionHistory()
  if (global == null) global = {}
  if (session == null) session = {}

  showHistory(document.getElementById('global-hist'), global)
  showHistory(document.getElementById('session-hist'), session)
</script>
<?php endblock() ?>
