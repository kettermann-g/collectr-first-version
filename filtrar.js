function filtrar(idInputTextFiltrar, idTabelaFiltrar) {

  var input, filtro, tabela, tr, td, i, txtValue;
  input = document.getElementById(idInputTextFiltrar);
  filtro = input.value.toUpperCase();
  tabela = document.getElementById(idTabelaFiltrar);
  tr = tabela.getElementsByTagName("tr");


  for (i = 1; i < tr.length; i++) {
    td = tr[i];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filtro) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}