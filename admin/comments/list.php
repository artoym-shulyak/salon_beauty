<?php

if ($_GET['sort'] === 'Сотрудники') {
	$comments = getAllEmployeeComments();
} elseif ($_GET['sort'] === 'Бренды') {
	$comments = getAllBrandComments();
} else {
	$comments = getAllComments();
}
