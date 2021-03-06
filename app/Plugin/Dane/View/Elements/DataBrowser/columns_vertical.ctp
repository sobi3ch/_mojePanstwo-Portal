<?
$this->Combinator->add_libs('js', '../plugins/highcharts/js/highcharts');
$this->Combinator->add_libs('js', '../plugins/highcharts/locals');
?>

<? if(!isset($this->request->query['conditions'][$map['field']])) { ?>
    <div class="agg agg-HorizontalVertical" data-choose-request="<?= $map['chooseRequest']; ?>" data-chart="<?= htmlentities(json_encode($data)) ?>">
        <div class="chart"></div>
    </div>
<? } else { ?>
    <p class="label-browser">
        <a href="<?= $map['cancelRequest']; ?>" aria-label="Close">
            <span class="label label-primary">
                <span aria-hidden="true">&times;</span>&nbsp;
                <?= $data['buckets'][0]['label']['buckets'][0]['key']; ?>
            </span>
        </a>
    </p>
<? } ?>