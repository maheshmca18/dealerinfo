<?php echo $header; ?>
<div class="container">


    <table class="table table-bordered">
        <thead>
        <tr>

            <td class="text-left">
                <a href="" class=""><?php echo "Postcode"; ?></a>
            </td>

            <td class="text-left">
                <a href="" class=""><?php echo "weight"; ?></a>
            </td>

            <td class="text-center">
                <a href="" class=""><?php echo "Shipping charge"; ?></a>
            </td>

        </tr>


        <?php if ($postcodemaster) { ?>

        <?php $temp=0; ?>

        <?php foreach ($postcodemaster as $postcode) { ?>

        <?php foreach ($postcode as $postcodecount) { ?>

        <?php $result = count($postcode);?>

        <tr>

            <?php

            if($temp!=$postcodecount['postcode']) { ?>

            <td class="text-left" rowspan="<?php echo $result; ?>"><?php echo $postcodecount['postcode']; ?></td>

            <?php } ?>

            <?php  $temp=$postcodecount['postcode']; ?>

            <td class="text-left"><?php if($postcodecount['condition_type']==2 ) { echo "Between   ".$postcodecount['min_weight'].'kg  to  '.$postcodecount['max_weight'].'kg'; } elseif($postcodecount['condition_type']==1) { echo "Below     ". $postcodecount['min_weight'].'kg'; } elseif($postcodecount['condition_type']==3) {  echo "Above      ".$postcodecount['max_weight'].'kg'; } ?> </td>

            <td class="text-center"><?php echo $postcodecount['shipping_charge']; ?></td>

        </tr>
<?php } } } ?>

    </table>


    <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
    </div>


</div>
</div>
<?php echo $footer; ?>



