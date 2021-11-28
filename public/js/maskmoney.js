$(document).ready(function () {
  $(".dinheiro").mask("#.##0,00", { reverse: true });
  $("#cep").mask("00000-000");
  $("#fone").mask("(00) 00000-0000");
});
