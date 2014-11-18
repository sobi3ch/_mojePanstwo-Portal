<?php
$this->Combinator->add_libs('css', $this->Less->css('wyjazdy_poslow', array('plugin' => 'WyjazdyPoslow')));
$this->Combinator->add_libs('js', '../plugins/highcharts/js/highcharts');
$this->Combinator->add_libs('js', '../plugins/highcharts/locals');
$this->Combinator->add_libs('js', '../plugins/highcharts/plugin/map');
//$this->Combinator->add_libs('js', '../plugins/highmaps/js/highmaps');
$this->Combinator->add_libs('js', 'WyjazdyPoslow.wyjazdy_poslow.js');
?>

<? /*
<div class="app-header">
	<div class="container">
		<h1>Wyjazdy zagraniczne posłów</h1>

        <p class="desc">       
	        Sprawdź gdzie latają podróżują w ramach swojej pracy. <a href="http://blog.epf.org.pl/2014/11/afera-madrycka/" target="_blank">Przeczytaj także o metodologii i kontrowersjach</a> związanych z tymi danymi.
	    </p>
	    
	</div>
</div>
*/
?>

<div class="maplabel">
    Kliknij na podświetlone Państwo, aby poznać szczegóły wyjazdów.
</div>

<div id="wyjazdyPoslowMap" class="loading"></div>

<div class="container">

<div class="stats text-center">
	
	<div class="bigger">
		<p class="_label">Na podróże posłów w VII Kadencji Sejmu, wydaliśmy:</p>
		<p class="_value"><?= $this->Waluta->slownie( $stats['koszta']['calosc'] ) ?></p>
	</div>
	
	<div class="row">
		<div class="col-md-3">
			<p class="_label">Na trasport</p>
			<p class="_value"><?= $this->Waluta->slownie( $stats['koszta']['transport'] ) ?></p>
		</div>
		<div class="col-md-3">
			<p class="_label">Na hotele</p>
			<p class="_value"><?= $this->Waluta->slownie( $stats['koszta']['hotele'] ) ?></p>
		</div>
		<div class="col-md-3">
			<p class="_label">Na diety</p>
			<p class="_value"><?= $this->Waluta->slownie( $stats['koszta']['diety'] ) ?></p>
		</div>
		<div class="col-md-3">
			<p class="_label">Pozostałe koszta</p>
			<p class="_value"><?= $this->Waluta->slownie( $stats['koszta']['pozostale'] ) ?></p>
		</div>
	</div>
	
</div>

<div class="baner">
	<p>Chcesz wiedzieć na co jeszcze posłowie wydają pieniądze?</p>
	<p><a class="btn btn-medium btn-primary" href="/wydatki_poslow">Zobacz wszystkie wydatki biur poselskich &raquo;</a></p>
</div>

<div class="block-group">
<div class="block">

    <div class="block-header">
        <h2 class="label">Najwięcej na podróże wydali</h2>
    </div>

    <div class="content row">
        <div class="col-md-5">

            <h3>Indywidualnie</h3>

            <ul>
                <? foreach ($stats['calosc']['indywidualne'] as $i) { ?>
                    <li class="row">
                        <div class="col-md-2 text-right">
                            <img class="border"
                                 src="http://resources.sejmometr.pl/mowcy/a/2/<?= $i['mowca_id'] ?>.jpg"/>
                        </div>
                        <div class="col-md-10">
                            <p class="title"><a href="/dane/poslowie/<?= $i['id'] ?>/wyjazdy"><?= $i['nazwa'] ?></a>
                                    <span class="klub">(<a
                                            href="/dane/sejm_kluby/<?= $i['klub_id'] ?>"><?= $i['skrot'] ?></a>)</span>
                            </p>

                            <p class="desc"><?= pl_dopelniacz($i['count'], 'wyjazd', 'wyjazdy', 'wyjazdów') ?> na
                                kwotę <?= _currency($i['sum']) ?></p>
                        </div>
                    </li>
                <? } ?>
            </ul>

            <p class="text-center"><a class="btn btn-sm btn-default" href="#">Zobacz pełny ranking</a></p>

        </div>
        <div class="col-md-7">

            <h3>Średnio na posła, według klubów</h3>

            <?php
            $klubowoChartData = array();
            foreach ($stats['calosc']['klubowe'] as $i) {
                array_push($klubowoChartData, array(
                    "name" => $i['skrot'],
                    "fullname" => $i['nazwa'],
                    "link" => "/dane/sejm_kluby/" . $i['id'],
                    "image" => "http://resources.sejmometr.pl/s_kluby/" . $i['id'] . "_s_t.png",
                    "ilosc" => (int) $i['count'],
                    "y" => round($i['avg'], 2),
                    "sum" => round($i['sum'], 2)
                ));
            };?>
            <div class="pieChartKlubowo" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"
                 data-kluby='<?php echo json_encode($klubowoChartData) ?>'></div>

        </div>
    </div>

</div>



<div class="block">

    <div class="block-header">
        <h2 class="label">Najdroższe wyjazdy</h2>
    </div>

    <div class="content row">
        
        <div class="col-md-6">

            <h3>Całościowo</h3>

            <ul>
	            <? foreach ($stats['najdrozsze']['calosc'] as $i) { ?>
                    <li class="row">
  
                        <div class="col-md-12">
                            <p class="title">
	                            <a href="#"><?= $i['delegacja']  ?></a>
                            </p>
							
							<p class="loc">
								<?= $i['lokalizacja'] ?>
							</p>
							
                            <p class="desc"><?= _currency($i['koszt']) ?> <span class="separator">|</span> <?= pl_dopelniacz($i['liczba_dni'], 'dzień', 'dni', 'dni') ?> <span class="separator">|</span> <?= pl_dopelniacz($i['liczba_poslow'], 'posel', 'posłów', 'posłów') ?></p>
                        </div>
                    </li>
                <? } ?>
                
            </ul>
            
            <p class="text-center"><a class="btn btn-sm btn-default" href="#">Zobacz pełny ranking</a></p>

        </div>
        
        <div class="col-md-6">

            <h3>Indywidualnie</h3>

            <ul>
                <? foreach ($stats['najdrozsze']['indywidualnie'] as $i) { ?>
                    <li class="row">
                        <div class="col-md-2 text-right">
                            <img class="border"
                                 src="http://resources.sejmometr.pl/mowcy/a/2/<?= $i['mowca_id'] ?>.jpg"/>
                        </div>
                        <div class="col-md-10">
                            <p class="title"><a href="/dane/poslowie/<?= $i['id'] ?>/wyjazdy"><?= $i['nazwa'] ?></a>
                                    <span class="klub">(<a
                                            href="/dane/sejm_kluby/<?= $i['klub_id'] ?>"><?= $i['skrot'] ?></a>)</span>
                            </p>
							
							<div class="desc-loc-cont">
	                            <p class="desc pull-left"><?= _currency($i['koszt']) ?></p>
	                            <p class="loc pull-right"><?= $i['lokalizacja'] ?></p>
							</div>
                        </div>
                    </li>
                <? } ?>
            </ul>

            <p class="text-center"><a class="btn btn-sm btn-default" href="#">Zobacz pełny ranking</a></p>

        </div>
        
    </div>

</div>


<div class="block">

    <div class="block-header">
        <h2 class="label">Wyjazdy posłów, a prace w Sejmie</h2>
    </div>

    <div class="content">

        <p>Poniżej prezentujemy daty zagranicznych wydarzeń, w których brali udział posłowie pokrywające się z datami
            głosowań, na których ci sami posłowie byli obecni w Sejmie.</p>

        <p>Zestawienie tych danych nie jest równoznaczne z nieobecnością posłów w delegacjach. Jak poinformowała
            Kancelaria Sejmu niektórzy z posłów skracali swój pobyt w czasie dłuższych delegacji ze względu na obowiązek
            wzięcia udziału w głosowaniach w Polsce.</p>


    </div>

</div>


<div class="col-md-10 col-md-offset-1">

	<ul class="controversy">
	
		<? foreach( $stats['wydarzenia'] as $w ) { ?> 
			
			<li>
				
				
				<div class="loc">
					<p class="w_title pull-left"><a href="#"><?= $w['data']['delegacja'] ?></a></p>
					<p class="pull-right"><span class="licza_dni"><?= pl_dopelniacz($w['data']['liczba_dni'], 'dzień', 'dni', 'dni') ?></span> <span class="label label-warning"><?= $w['data']['date_start'] ?> - <?= $w['data']['date_stop'] ?></span></p> 
				</div>
				
				<p class="desc"><?= $w['data']['lokalizacja'] ?></p>
				
				<ul class="poslowie">
					
					<li class="row">
						<p class="col-sm-4">Poseł</p>
						<p class="col-sm-2">Transport</p>
						<p class="col-sm-2">Hotel</p>
						<p class="col-sm-2">Dieta</p>
						<p class="col-sm-2 text-right">Aktywności w Sejmie</p>
					</li>
					
				<? foreach( $w['poslowie'] as $p ) {?>
				
					<li class="row">
						
						<p class="col-sm-4">
							<img class="border"
                                 src="http://resources.sejmometr.pl/mowcy/a/3/<?= $p['mowca_id'] ?>.jpg"/>
							<a class="title" href="#"><?= $p['nazwa'] ?></a> <span class="klub"><a href="#"><?= $p['klub_skrot'] ?></a></span> 
						</p>
						<p class="col-sm-2">
							<?= _currency($p['koszt_transport']) ?>
						</p>
						<p class="col-sm-2">
							<?= _currency($p['koszt_hotel']) ?>
						</p>
						<p class="col-sm-2">
							<?= _currency($p['koszt_dieta']) ?>
						</p>
						<p class="col-sm-2 text-right">
							<span class="label label-danger"><?= implode('</span> <span class="label label-danger">', $p['glosowania_dni']) ?></span>
						</p>
						
					</li>
				
				<? } ?>
				</ul>
			
			</li>
			
		<? /*
		<li class="row">
		    <div class="col-md-1 text-right">
		        <img class="border" src="http://resources.sejmometr.pl/mowcy/a/2/9.jpg"/>
		    </div>
		    <div class="col-md-11">
		        <p class="title"><a href="/dane/poslowie/12">Paweł Arndt</a> <span class="klub">(<a
		                    href="/dane/sejm_kluby/1">PO</a>)</span></p>
		
		        <p class="event">CHORWAC JA Dubrownik. ZP NATO Doroczna sesja</p>
		
		        <p class="dates">Wydarzenie w dniach: <span class="label label-warning">2013-10-10 - 2013-10-15</span>. Poseł
		            głosował w Sejmie w dniach: <span class="label label-danger">2013-10-11</span></p></div>
		</li>
		<? */ ?>
		
		<? } ?>
	
	
	</ul>

</div>


</div>

</div>