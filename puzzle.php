<!DOCTYPE html>
<html lang="en">
<head>
    <title>Portal cells</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="copyright" content="Maciej Jaros">

	<link rel="stylesheet" type="text/css" href="puzzle.css">
	<link rel="icon" href="img/icon.svg" sizes="any" type="image/svg+xml">

	<script src="js/main.js" type="module"></script>
</head>
<body>
	<main>
		<section id="zoomer" class="medium3">
			<figure class="main">
				<img src="img-auto-cut/cells/col_001_001.jpg" />
				<figcaption></figcaption>
			</figure>
			<section id="zoomer-controls" style="display: none;">
				<button class="resize" data-class="small">small (6)</button>
				<button class="resize" data-class="medium5">5</button>
				<button class="resize" data-class="medium4">4</button>
				<button class="resize" data-class="medium3">3</button>
				<button class="resize" data-class="medium2">2</button>
				<button class="resize" data-class="big">big (1)</button>
				<button class="clear">clear</button>
			</section>
			<section id="zoomer-list">
			</section>
		</section>
		<section id="columns">
			<section>
			<?php
				// params for testing
				// e.g.: puzzle.php?dir=cells_&column=2
				$dir = !empty($_GET['dir']) ? $_GET['dir'] : "cells";
				$startCol = !empty($_GET['column']) ? $_GET['column'] : 1;

				$base = "./img-auto-cut/$dir/";
				$rowCounts = array();
				for ($column=$startCol; $column < 30; $column++) {
					$files = glob($base . sprintf("/col_%03d_*.jpg", $column));
					if (empty($files)) {
						break;
					}
					$rowCounts[$column] = count($files);
					//echo '<section class="column" id="col_'.$column.'"><h2>'.$column.' <em>('.count($files).')</em></h2>';
					echo '<section class="column" id="col_'.$column.'"><h2>'.$column.'</h2>';
					foreach ($files as $file) {
						$id = preg_replace('#\.\w+$#', '', basename($file));
						$title = preg_replace('#.+?0*([0-9]+).+?0*([0-9]+).*#', 'col $1, row $2', $id);
						echo "<img src='$file' id='cell_{$id}' title='{$title}' />";
					}
					echo '</section>';
				}
			?>
			</section>
		</section>
		<section id="controls">
			<button id="reset-all">reset all</button>
			&nbsp; &bull; &nbsp; No. of portals (per column): <input type="text" value="<?=implode("\t", $rowCounts)?>"/>
			<p>&nbsp; &bull; &nbsp;<a href="img-auto-cut/all.jpg" target="_blank">all.jpg</a>
		</section>
	</main>

	<script>
		// css: var(--scrollbar-width)
		//document.documentElement.style.setProperty('--scrollbar-width', (window.innerWidth - document.documentElement.clientWidth) + "px");		
	</script>
</body>
</html>