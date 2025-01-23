<?php
function getOrderStatusText($status) {
  switch ($status) {
    case 1:
      return 'Niet verwerkt';
    case 2:
      return 'In behandeling';
    case 3:
      return 'Afgeleverd';
    default:
      return 'Onbekend';
  }
}

function getOrderStatusClass($status) {
  switch ($status) {
    case 1:
      return 'not-processed';
    case 2:
      return 'in-progress';
    case 3:
      return 'delivered';
    default:
      return 'unknown';
  }
}
?>