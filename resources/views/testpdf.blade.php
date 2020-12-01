<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<svg id="ean-13"></svg>
	<button id="printpdf">PRINT PDF</button>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.3/JsBarcode.all.min.js" integrity="sha512-TLB7v1Y4YHGy/EHUu5VZ2bl6sC/WvXh/NFdjEZ7JmbpsUG87dirXAOFSAS3O6Tn3rsZljFTcTdMz9PDM4mV26g==" crossorigin="anonymous"></script>
	<script type="text/Javascript">
		JsBarcode("#ean-13", "1234567890128", {format: "ean13"});
		$('#printpdf').click(function(){
			ajax
		})
	</script>
</body>
</html>