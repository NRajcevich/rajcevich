<?php
$alternative_count = 0;
$secure_count = 0;

$gender = array('maleA' => 0,'maleS' => 0,'femaleA' => 0,'femaleS' => 0);
$ethtnicity = array();
$ages = array();
$residences = array();

foreach($modelD as $detention){

    if($detention->attributes['detention_type'] == 'Alternative') {
        $alternative_count++;

        // Gender
        if($detention->attributes['gender'] == 'Male') $gender['maleA']++;
        if($detention->attributes['gender'] == 'Female') $gender['femaleA']++;


    }
    if($detention->attributes['detention_type'] == 'Secure') {
        $secure_count++;

        // Gender
        if($detention->attributes['gender'] == 'Male') $gender['maleS']++;
        if($detention->attributes['gender'] == 'Female') $gender['femaleS']++;
    }


    //Race/Ethnicity
    if(is_array($ethtnicity) && array_key_exists($detention->attributes['race'], $ethtnicity)){
        if($detention->attributes['detention_type'] == 'Alternative') $ethtnicity[$detention->attributes['race']]['countA']++;
        if($detention->attributes['detention_type'] == 'Secure') $ethtnicity[$detention->attributes['race']]['countS']++;
    }else{
        $ethtnicity[$detention->attributes['race']]['countA'] = 0;
        $ethtnicity[$detention->attributes['race']]['countS'] = 0;

        $ethtnicity[$detention->attributes['race']]['race'] = $detention->attributes['race'];

        if($detention->attributes['detention_type'] == 'Alternative') $ethtnicity[$detention->attributes['race']]['countA'] = 1;
        if($detention->attributes['detention_type'] == 'Secure') $ethtnicity[$detention->attributes['race']]['countS'] = 1;
    }

    // Age admission
    if($detention->attributes['dob'] != '1900-01-01' || !$detention->attributes['dob']){
        $dob = new DateTime($detention->attributes['dob']);
        $now_date = new DateTime('now');
        $interval = $now_date->diff($dob);
        $the_age = $interval->y;

        if(is_array($ages) && array_key_exists($the_age, $ages)){
            if($detention->attributes['detention_type'] == 'Alternative') {
                $ages[$the_age]['countA']++;
                $ages['average'] += $the_age;
                $ages['countA']++;
            }
            if($detention->attributes['detention_type'] == 'Secure') {
                $ages[$the_age]['countS']++;
                $ages['average'] += $the_age;
                $ages['countS']++;
            }
        }else{
            $ages[$the_age]['countA'] = 0;
            $ages[$the_age]['countS'] = 0;
            $ages['average'] = 0;
            $ages['countA'] = 0;
            $ages['countS'] = 0;

            $ages[$the_age]['age'] = $the_age;

            if($detention->attributes['detention_type'] == 'Alternative') {
                $ages[$the_age]['countA'] = 1;
                $ages['average'] += $the_age;
                $ages['countA']++;
            }
            if($detention->attributes['detention_type'] == 'Secure') {
                $ages[$the_age]['countS'] = 1;
                $ages['average'] += $the_age;
                $ages['countS']++;
            }
        }
    }

    //Town of Residence
    if(is_array($residences) && array_key_exists($detention->attributes['residence'], $residences)){
        if($detention->attributes['detention_type'] == 'Alternative') $residences[$detention->attributes['residence']]['countA']++;
        if($detention->attributes['detention_type'] == 'Secure') $residences[$detention->attributes['residence']]['countS']++;
    }else{
        $residences[$detention->attributes['residence']]['countA'] = 0;
        $residences[$detention->attributes['residence']]['countS'] = 0;

        $residences[$detention->attributes['residence']]['town'] = $detention->attributes['residence'];

        if($detention->attributes['detention_type'] == 'Alternative') $residences[$detention->attributes['residence']]['countA'] = 1;
        if($detention->attributes['detention_type'] == 'Secure') $residences[$detention->attributes['residence']]['countS'] = 1;
    }

}

krsort($ages);
reset($ages);

?>

<div class="col-sm-12">
    <section class="panel">
        <header class="panel-heading">Demographics</header>
        <div class="panel-body" style="display: block;">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="33%"></th>
                    <th width="33%" colspan="2">Detention Alternatives (N=<?=$alternative_count?>)</th>
                    <th width="33%" colspan="2">Secure Detention (N=<?=$secure_count?>)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>Gender</th><th width="16%" style="text-align:center;">%</th><th width="16%" style="text-align:center;">#</th><th width="16%" style="text-align:center;">%</th><th width="16%" style="text-align:center;">#</th>
                </tr>
                <tr>
                    <td>Male</td>
                    <td><?=(round($gender['maleA']/$alternative_count, 3)*100)."%"; ?></td>
                    <td><?=$gender['maleA']?></td>
                    <td><?=(round($gender['maleS']/$secure_count, 3)*100)."%"; ?></td>
                    <td><?=$gender['maleS']?></td>
                </tr>
                <tr>
                    <td>Female</td>
                    <td><?=(round($gender['femaleA']/$alternative_count, 3)*100)."%"; ?></td>
                    <td><?=$gender['femaleA']?></td>
                    <td><?=(round($gender['femaleS']/$secure_count, 3)*100)."%"; ?></td>
                    <td><?=$gender['femaleS']?></td>
                </tr>
                <tr>
                    <th>Race/Ethnicity</th><th></th><th></th><th></th><th></th>
                </tr>
                <?php if(count($ethtnicity)>0) foreach($ethtnicity as $race){ ?>
                    <?php if(!empty($race['race'])){ ?>
                    <tr>
                        <td><?=$race['race']?></td>
                        <td><?=(round($race['countA']/$alternative_count, 3)*100)."%"; ?></td>
                        <td><?=$race['countA'] ?></td>
                        <td><?=(round($race['countS']/$secure_count, 3)*100)."%"; ?></td>
                        <td><?=$race['countS'] ?></td>
                    </tr>
                <?php }} ?>
                <tr>
                    <th>Age at Admission</th><th></th><th></th><th></th><th></th>
                </tr>
                <?php if(count($ages)>0) foreach($ages as $this_age){ if(!empty($this_age['age']) && $this_age['age'] != "average" && $this_age['age'] != "countA" && $this_age['age'] != "countS"){ ?>
                    <tr>
                        <td><?=$this_age['age'] ?></td>
                        <td><?=(round($this_age['countA']/$alternative_count, 3)*100)."%"; ?></td>
                        <td><?=$this_age['countA'] ?></td>
                        <td><?=(round($this_age['countS']/$secure_count, 3)*100)."%"; ?></td>
                        <td><?=$this_age['countS'] ?></td>
                    </tr>
                <?php }} ?>
                <tr>
                    <td>Average Age</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th>Town of Residence</th><th></th><th></th><th></th><th></th>
                </tr>
                <?php if(count($residences)>0) foreach($residences as $tor){ ?>
                    <tr>
                        <td><?=$tor['town'] ?></td>
                        <td><?=(round($tor['countA']/$alternative_count, 3)*100)."%"; ?></td>
                        <td><?=$tor['countA'] ?></td>
                        <td><?=(round($tor['countS']/$secure_count, 3)*100)."%"; ?></td>
                        <td><?=$tor['countS'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </section>
</div>