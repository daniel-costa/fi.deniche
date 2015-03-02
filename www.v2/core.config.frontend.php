<?php

	$do_not_require_auth = true;

	include_once('../backend/core.config.php');

	include 'language.' . getLang() . '.php';

	function toggleFromFilter($value, $filter) {
		if(($key = array_search($value, $_SESSION['filters'][$filter])) !== false) {
			unset($_SESSION['filters'][$filter][$key]);
		} else {
			$_SESSION['filters'][$filter][] = $value;
		}
	}

	function getProductImages($product_id) {
		global $sql;

		$images = array();

		$stmt = $sql->prepare("SELECT id FROM product_image WHERE product = $product_id");
		$stmt->execute();
		$stmt->bind_result($id);
		while ($stmt->fetch()) {
			array_push($images, $id);
		}

		$stmt->close();

		return $images;
	}

	function getProduct($product) {
		global $sql;

		$stmt = $sql->prepare("SELECT p.id, m.name, m.id, p.price, p.bargain, c.name, c.hexa_light, c.hexa_original, (SELECT id FROM product_image WHERE thumb = 1 and product = p.id LIMIT 0, 1)
								FROM product p
								LEFT JOIN model m  ON m.id = p.model
								LEFT JOIN color c ON c.id = p.color
								WHERE p.id = ?");

		$stmt->bind_param("i", $product);
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows !== 1 ) {
			return false;
		}

		$stmt->bind_result($id, $model, $model_id, $price, $bargain, $color, $hexa_light, $hexa_original, $thumb);
		$stmt->fetch();
		$stmt->close();

		return array(
			'id' => $id,
			'model' => $model,
			'color' => $color,
			'price' => $price,
			'bargain' => $bargain,
			'hexa_light' => empty($hexa_light) ? 'F2FAFB' : $hexa_light,
			'hexa_original' => empty($hexa_light) ? 'F2FAFB' : $hexa_original,
			'thumb' => "binaries/products/img-$thumb-thumb.png"
		);
		
	}
?>
