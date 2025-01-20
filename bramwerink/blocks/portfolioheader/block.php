<p>test</p>
<?php 
$bedrijfsnaam = get_field('bedrijfsnaam');
if ($bedrijfsnaam) {
    echo $bedrijfsnaam;
} else {
    echo 'No value for bedrijfsnaam';
}
?>
<p>test 2</p>
