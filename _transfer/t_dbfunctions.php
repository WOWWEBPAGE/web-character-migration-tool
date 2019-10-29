﻿<?php
/*
 * Copyright (C) 2019+ MasterkinG32 <https://masterking32.com>
 * Copyright (C) 2017+ AzerothCore <www.azerothcore.org>, released under GNU GPL v2 license: http://github.com/azerothcore/azerothcore-wotlk/LICENSE-GPL2
 * Copyright (C) 2008-2016 TrinityCore <http://www.trinitycore.org/>
 * Copyright (C) 2005-2009 MaNGOS <http://getmangos.com/>
*/
    include_once('t_config.php');
    include_once('language.php');

    function _X($C,$A) {
        return get_magic_quotes_gpc() ? stripslashes(mysqli_real_escape_string($C,$A)) : mysqli_real_escape_string($C,$A);
    }

    function _CheckCharacterOnlineStatus($DBHost, $DB_PORT, $DBUser, $DBPassword, $CharactersDB, $GUID) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$CharactersDB,$DB_PORT) or die(mysqli_error($connection));
        _SelectDB($connection);
        $query  = mysqli_query($connection,"SELECT `online` FROM `characters` WHERE `guid` = ". $GUID .";") or die(mysqli_error($connection));
        $result = mysqli_fetch_array($query);
        mysqli_close($connection);
        return $result[0] == 0 ? true : false;
    }

    function CheckTransferStatus($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $ID) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        
        $query = mysqli_query($connection,"SELECT `cStatus` FROM `account_transfer` WHERE `id` = ". (int)$ID .";") or die(mysqli_error($connection));
        $row = mysqli_fetch_array($query);
        mysqli_close($connection);
        return $row['cStatus'];
    }

    function CanOrNoTransferPlayer($DBHost, $DB_PORT, $DBUser, $DBPassword, $CharactersDB, $AccountID) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$CharactersDB,$DB_PORT) or die(mysqli_error($connection));
        _SelectDB($connection);
        $query  = mysqli_query($connection,"SELECT COUNT(*) FROM `characters` WHERE `account` = ". $AccountID .";") or die(mysqli_error($connection));
        $result = mysqli_fetch_array($query);
        mysqli_close($connection);
        return $result[0] < 9 ? false : true;
    }

    function CanOrNoTransferServer($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $RealmID, $GMLevel) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        
        //echo "<br> DELETE FROM `account_transfer_queue`;";
        $query = mysqli_query($connection,"DELETE FROM `account_transfer_queue`;") or die(mysqli_error($connection));
        //echo "<br> INSERT IGNORE INTO `account_transfer_queue`(`id`) SELECT `id` FROM `account_access`;";
        $query = mysqli_query($connection,"INSERT IGNORE INTO `account_transfer_queue`(`id`) SELECT `account_id` FROM `account_permissions` WHERE `permission_mask` IN ". $GMLevel .";") or die(mysqli_error($connection));
        //echo "<br> SELECT `id` FROM `account_transfer_queue`";
        $query = mysqli_query($connection,"SELECT `id` FROM `account_transfer_queue`");
        mysqli_close($connection);
        while($result = mysqli_fetch_array($query)) {
            $ACCOUNT_ID = $result[0];
            //echo "<br> < 1st WHILE CYCLE > Reviewer ID: ". $ACCOUNT_ID;
            UPDATEReviewer($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $ACCOUNT_ID);
        }
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        
        $REVIEWER_ID    = -1;
        $MIN            = 8;
        //echo "<br> SELECT `id`,`Realm". $ID ."` FROM `account_transfer_queue`";
        $query = mysqli_query($connection,"SELECT `id`,`Realm". $RealmID ."` FROM `account_transfer_queue`");
        while($result = mysqli_fetch_array($query)) {
            if($result[1] == 0){
                $REVIEWER_ID = $result[0];
                //echo "<br> < 2nd WHILE CYCLE \\ IF 0 Queue>  Reviewer ID: ". $REVIEWER_ID;
                return $REVIEWER_ID;
            } else if($result[1] < $MIN) {
                $MIN            = $result[1];
                $REVIEWER_ID    = $result[0];
                //echo "<br> < 2nd WHILE CYCLE \\ Else >  Reviewer ID: ". $REVIEWER_ID;
            }
        }
        if($REVIEWER_ID < 0)
            return -1;
        else
            return $REVIEWER_ID;
    }

    function _CheckBlackList($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $VALUE) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        
        $query = mysqli_query($connection,"SELECT `b_address` FROM `account_transfer_blacklist` WHERE `b_address` LIKE \"%". _X($connection,trim($VALUE)) ."%\";") or die(mysqli_error($connection));
        $row = mysqli_fetch_array($query);
        mysqli_close($connection);
        return $row ? true : false;
    }

    function UPDATEReviewer($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $ACCOUNT_ID) {
        $Realm1     = CountQueue(_HostDBSwitch(1), $DB_PORT, $DBUser, $DBPassword, _CharacterDBSwitch(1), $ACCOUNT_ID);
        $Realm2     = CountQueue(_HostDBSwitch(2), $DB_PORT, $DBUser, $DBPassword, _CharacterDBSwitch(2), $ACCOUNT_ID);
        $Realm3     = CountQueue(_HostDBSwitch(3), $DB_PORT, $DBUser, $DBPassword, _CharacterDBSwitch(3), $ACCOUNT_ID);
        $Realm4     = CountQueue(_HostDBSwitch(4), $DB_PORT, $DBUser, $DBPassword, _CharacterDBSwitch(4), $ACCOUNT_ID);
        $Realm5     = CountQueue(_HostDBSwitch(5), $DB_PORT, $DBUser, $DBPassword, _CharacterDBSwitch(5), $ACCOUNT_ID);
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        
        $query = mysqli_query($connection,"UPDATE `account_transfer_queue` SET
        `Realm1`    = ". $Realm1 .",
        `Realm2`    = ". $Realm2 .",
        `Realm3`    = ". $Realm3 .",
        `Realm4`    = ". $Realm4 .",
        `Realm5`    = ". $Realm5 ."
        WHERE `id` = ". $ACCOUNT_ID.";") or die(mysqli_error($connection));
        mysqli_close($connection);
    }

    function CountQueue($DBHost, $DB_PORT, $DBUser, $DBPassword, $CharacterDB, $ACCOUNT_ID) {
        if($CharacterDB < 0 || $DBHost < 0)
            return 0;
        else {
            $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$CharacterDB,$DB_PORT) or die(mysqli_error($connection));
            _SelectDB($CharacterDB);
            $query = mysqli_query($connection,"SELECT COUNT(*) FROM `characters` WHERE `account` = ". $ACCOUNT_ID .";") or die(mysqli_error($connection));
            $result = mysqli_fetch_array($query);
            mysqli_close($connection);
            //echo " Characters Count: ". $result[0];
            return $result[0];
        }
    }

    function GetRealmID($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $Realm) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        
        $query = mysqli_query($connection,"SELECT `realm_id` FROM `realms` WHERE `name` = \"". _X($connection,$Realm) ."\";") or die(mysqli_error($connection));
        $row = mysqli_fetch_array($query);
        mysqli_close($connection);
        return $row['realm_id'];
    }

    function GetCharacterGuid($DBHost, $DB_PORT, $DBUser, $DBPassword, $CharactersDB) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$CharactersDB,$DB_PORT) or die(mysqli_error($connection));
        _SelectDB($connection);
        $query = mysqli_query($connection,"SELECT MAX(`guid`) FROM `characters` WHERE `guid`;") or die(mysqli_error($connection));
        $row = mysqli_fetch_array($query);
        mysqli_close($connection);
		if(empty($row[0]))
		{
			return 1;
		}
        return $row[0] + 1;
    }
    function CancelORDenyCharacterTransfer($DBHost, $DB_PORT, $DBUser, $DBPassword, $CharactersDB, $GUID, $STORAGE) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$CharactersDB,$DB_PORT) or die(mysqli_error($connection));
        _SelectDB($connection);
        mysqli_query($connection,"UPDATE `characters` SET `name` = (SELECT `dump_id` FROM `character_transfer` WHERE `guid` = ". $GUID ."),`account` = ". $STORAGE ." WHERE `guid` = ". $GUID .";") or die(mysqli_error($connection));
        mysqli_close($connection);
    }

    function ApproveCharacterTransfer($DBHost, $DB_PORT, $DBUser, $DBPassword, $CharactersDB, $GUID) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$CharactersDB,$DB_PORT) or die(mysqli_error($connection));
        _SelectDB($connection);
        mysqli_query($connection,"UPDATE `characters` SET `account` = (SELECT `player_account` FROM `character_transfer` WHERE guid = ". $GUID .") WHERE `guid` = ". $GUID .";") or die(mysqli_error($connection));
        mysqli_close($connection);
    }

    function MoveToGMAccount($DBHost, $DB_PORT, $DBUser, $DBPassword, $CharactersDB, $GUID) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$CharactersDB,$DB_PORT) or die(mysqli_error($connection));
        _SelectDB($connection);
        mysqli_query($connection,"UPDATE `characters` SET `account` = (SELECT `gm_account` FROM `character_transfer` WHERE `guid` = ". $GUID .") WHERE `guid` = ". $GUID .";") or die(mysqli_error($connection));
        mysqli_close($connection);
    }

    function _SelectDB($connection) {
        //mysqli_set_charset($connection,"utf8");
		//mysqli_query($connection,"SET CHARACTER SET 'utf8'");
		//mysqli_query($connection,"SET SESSION collation_connection ='utf8_general_ci'");
    }

    function _CheckStatus($VALUE, $P1, $P2, $P3, $P4, $P5, $COMMENT = "") {
        switch($VALUE) {
            case 0:     return "<font color = \"blue\">".   $P1 ."</font>";
            case 1:     return "<font color = \"green\">".  $P2 ."</font>";
            case 2:     return "<font color = \"red\">".    $P3 . " | Realson: ". $COMMENT ."</font>";
            case 3:     return "<font color = \"purple\">". $P4 ."</font>";
            default:    return "<font color = \"orange\">". $P5 ."</font>";
        }
    }

    function _CheckReason($VALUE, $REASON) {
        switch($VALUE) {
            case 2:     return "title=\"". $REASON ."\"";
            default:    return "";
        }
    }

    function _CheckRealm($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $RealmID) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));

        $query = mysqli_query($connection,"SELECT `name` FROM `realms` WHERE `realm_id` = ". $RealmID .";") or die(mysqli_error($connection));
        $row = mysqli_fetch_array($query);
        mysqli_close($connection);
        return $row[0];
    }

    function _CheckGMAccess($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $ID, $GMLevel) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        $query = mysqli_query($connection,"SELECT * FROM `account_permissions` WHERE `account_id` = ". $ID ." AND `permission_mask` IN ". $GMLevel .";") or die(mysqli_error($connection));
        $row = mysqli_fetch_array($query);
        mysqli_close($connection);
        return $row ? true : false;
    }

    function _CheckCharacterName($DBHost, $DB_PORT, $DBUser, $DBPassword, $CharactersDB, $NAME) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$CharactersDB,$DB_PORT) or die(mysqli_error($connection));
        _SelectDB($connection);
        $query = mysqli_query($connection,"SELECT COUNT(*) AS `AMOUNT` FROM `characters` WHERE `name` = \"". _X($connection,$NAME) ."\";") or die(mysqli_error($connection));
        $row = mysqli_fetch_array($query);
        mysqli_close($connection);
        return $row["AMOUNT"];
    }

    function _GetCharacterName($DBHost, $DB_PORT, $DBUser, $DBPassword, $CharactersDB, $GUID) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$CharactersDB,$DB_PORT) or die(mysqli_error($connection));
        _SelectDB($connection);
        $query = mysqli_query($connection,"SELECT `name` FROM `characters` WHERE `guid` = ". (int)$GUID .";") or die(mysqli_error($connection));
        $row = mysqli_fetch_array($query);
        mysqli_close($connection);
        return $row["name"];
    }

    function UpdateCharacterName($DBHost, $DB_PORT, $DBUser, $DBPassword, $CharactersDB, $Name, $GUID) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$CharactersDB,$DB_PORT) or die(mysqli_error($connection));
        _SelectDB($connection);
        mysqli_query($connection,"UPDATE `characters` SET `name` = \"". _X($connection,$Name) ."\" WHERE `guid` = ". $GUID .";") or die(mysqli_error($connection));
        mysqli_close($connection);
        return $Name;
    }

    function LearnSeparateSpell($SpellID, $GUID,$connection) {
        if($SpellID < 1)
            return;
        mysqli_query($connection,"/* function GetExtraSpellForSkill */ INSERT IGNORE INTO `character_spell` VALUES (". $GUID .", ". (int)$SpellID .", 1, 0 );") or die(mysqli_error($connection));
    }

    function UpdateDumpStatus($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $ID, $STATUS) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        
        mysqli_query($connection,"UPDATE `account_transfer` SET `cStatus` = ".(int)$STATUS ." WHERE `id` = ". (int)$ID .";") or die(mysqli_error($connection));
        mysqli_close($connection);
    }

    function UpdateDumpSTATUSandNAME($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $ID, $NAME, $STATUS) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        
        mysqli_query($connection,"UPDATE `account_transfer` SET `cNameNew` = \"". _X($connection,$NAME) ."\", `cStatus` = ". (int)$STATUS ." WHERE `id` = ". (int)$ID .";") or die(mysqli_error($connection));
        mysqli_close($connection);
    }

    function UpdateDumpITEMROW($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $ID, $ROW) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        
        mysqli_query($connection,"UPDATE `account_transfer` SET `cItemRow` = \"". _X($connection,$ROW) ."\" WHERE `id` = ". (int)$ID .";") or die(mysqli_error($connection));
        mysqli_close($connection);
    }

    function LoadItemRoW($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $ID) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        
        $query = mysqli_query($connection,"SELECT `cItemRow` FROM `account_transfer` WHERE `id` = \"". (int)$ID ."\";") or die(mysqli_error($connection));
        $row = mysqli_fetch_array($query);
        mysqli_close($connection);
        return $row[0];
    }

    function LoadDump($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $ID) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        
        $query = mysqli_query($connection,"SELECT `cDump` FROM `account_transfer` WHERE `id` = \"". (int)$ID ."\";") or die(mysqli_error($connection));
        $row = mysqli_fetch_array($query);
        mysqli_close($connection);
        return $row[0];
    }

    function WriteDumpFromFileInDB($DBHost, $DB_PORT, $DBUser, $DBPassword, $AccountDB, $DUMP, $CHAR_NAME, $CHAR_ACCOUNT_ID, $CHAR_REALM,
                                    $o_Account, $o_Password, $O_REALMLIST, $O_REALM, $o_URL, $ID, $GUID, $GM_ACCOUNT, $ERROR) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$AccountDB,$DB_PORT) or die(mysqli_error($connection));
        
        $query = mysqli_query($connection,"INSERT INTO `account_transfer`(
        `cStatus`,`cRealm`,`oAccount`,`oPassword`,`oRealmlist`,`oRealm`,`oServer`,`cDump`,`cNameOLD`,`cNameNEW`,`cAccount`,`GUID`,`gmAccount`) VALUES (
        5,\"". _X($connection,$CHAR_REALM) ."\",\"". _X($connection,$o_Account) ."\",\"". _X($connection,$o_Password) ."\",\"". _X($connection,$O_REALMLIST) ."\",\"". _X($connection,$O_REALM) ."\",\"". _X($connection,$o_URL) ."\"
        ,\"". _X($connection,$DUMP) ."\",\"". _X($connection,$CHAR_NAME) ."\",\"". _X($connection,$CHAR_NAME) ."\",". $CHAR_ACCOUNT_ID .",". $GUID .",". $GM_ACCOUNT .");") or die(mysqli_error($connection));
        $ID         = mysqli_insert_id($connection);
        mysqli_close($connection);
        return $ID;
    }

    function RemoteCommandWithSOAP($SOAPUser, $SOAPPassword, $SOAPPort, $SOAPHost, $URI, $COMMAND) {
		$conn = new SoapClient(NULL, array(
			'location' => "http://$SOAPHost:$SOAPPort/",
			'uri'      => $URI,
			'style'    => SOAP_RPC,
			'login'    => $SOAPUser,
			'password' => $SOAPPassword
		));
		try 
  		{
   			$conn->executeCommand(new SoapParam($COMMAND, 'command'));
  		}
  		catch (Exception $e)
  		{
			//die("Something went wrong! An administrator has been noticed and will send your order as soon as possible.");
		}
		
        //$SOAP = new SOAP(array("soap_user" => "". $SOAPUser ."", "soap_pass" => "". $SOAPPassword ."", "soap_port" => "". $SOAPPort  ."", "addr" => "". $SOAPHost ."", "uri" => "". $URI .""));
        //$SOAP->fetch($COMMAND);
        //echo "<br>". $SOAP->fetch("". $COMMAND ."") ."<br>";
        unset($conn);
    }

    class SOAP {
        private $client = NULL;
    public
        function __construct($conArr) {
            if(!$this->connect($conArr['soap_user'], $conArr['soap_pass'], $conArr['addr'], $conArr['soap_port'], $conArr['uri']))
                die("SOAP UNABAIBLE CONNECT");
        }
    public
        function connect($soapUser, $soapPass, $soapHost, $soapPort, $soap_uri) {
            $this->client = new SoapClient(NULL, array(
                    "location"      => "http://".$soapHost.":".$soapPort."/",
                    "uri"           => "urn:". $soap_uri ."",
                    "user_agent"    => "aframework",
                    "style"         => SOAP_RPC,
                    "login"         => $soapUser,
                    "password"      => $soapPass,
                    "trace"         => 1,
                    "exceptions"    => 0
                )
            );

            if(is_soap_fault($this->client)) {
                $client = $this->client;
                throw new Exception("SOAP Error | Faultcode: ".$client->faultcode." | Faultstring: ".$client->faultstring);
                return false;
            }
            return true;
        }
    public
        function disconnect() {
            if($this->client != NULL)
                $this->client = NULL;
            else
                return false;
            return true;
        }
    public
        function fetch($command) {
            $client = $this->client;
            if($client == NULL)
                return false;
            $params = func_get_args();
            array_shift($params);
            $command = vsprintf($command, $params);
            $result = $client->executeCommand(new SoapParam($command, "command"));
            if(is_soap_fault($client)) {
                throw new Exception("SOAP Error | Faultcode: ".$client->faultcode." | Faultstring: ".$client->faultstring);
                return false;
            }
            return $this->getResult($client->__getLastResponse());
        }
    private
        function getResult($xmlresponse) {
            //echo "SOAP CLASS SAY:" . $xmlresponse;
            $start = strpos($xmlresponse,'<?xml');
            $end = strrpos($xmlresponse,'>');
            $soapdata = substr($xmlresponse,$start,$end-$start+1);
            $xml_parser = xml_parser_create();
            xml_parse_into_struct($xml_parser, $soapdata, $vals, $index);
            xml_parser_free($xml_parser);
            if(array_key_exists("RESULT",$index))
                $result = $vals[$index['RESULT'][0]]['value'];
            if(!empty($result))
                return $result;
            return "SOAP Server do not respond!";
        }
    }

    function _TalentsReset($DBHost, $DB_PORT, $DBUser, $DBPassword, $CharactersDB, $GUID) {
        $connection = mysqli_connect($DBHost, $DBUser, $DBPassword,$CharactersDB,$DB_PORT) or die(mysqli_error($connection));
        _SelectDB($connection);
        $query = mysqli_query($connection,"UPDATE `characters` SET `at_login` = `at_login`|4|16 WHERE `guid` = ". $GUID .";") or die(mysqli_error($connection));
        mysqli_close($connection);
    }

    function _CheckRiding($SKILL, $CUR, $connection, $GUID, $LEVEL) {
        $SpellID    = -1;
        switch($SKILL) {
            case "RIDING":          // enGB
            case "MONTE":           // frFR
            case "REITEN":          // deDE
            case "EQUITACIÓN":      // esES
            case "ВЕРХОВАЯ ЕЗДА":   // ruRU
                switch($CUR) {
                    case 75:    $SpellID = 33388;   break;
                    case 150:   $SpellID = 33391;   break;
                    case 225:   $SpellID = 34090;   break;
                    case 300:   $SpellID = 34091;
                        if($LEVEL == 80)
                            LearnSeparateSpell(54197, $GUID,$connection);
                        break;
                    default: return false;
                }
                LearnSeparateSpell($SpellID, $GUID,$connection);
                return true;
            default: return false;
       }
    }

    function DeathKnightTransfer($GUID) {
        return "INSERT INTO `character_queststatus_rewarded`(`guid`,`quest`) VALUES
            (". $GUID .", 12593),   (". $GUID .", 12619),   (". $GUID .", 12641),   (". $GUID .", 12657),
            (". $GUID .", 12670),   (". $GUID .", 12678),   (". $GUID .", 12679),   (". $GUID .", 12680),
            (". $GUID .", 12687),   (". $GUID .", 12697),   (". $GUID .", 12698),   (". $GUID .", 12700),
            (". $GUID .", 12701),   (". $GUID .", 12706),   (". $GUID .", 12711),   (". $GUID .", 12714),
            (". $GUID .", 12715),   (". $GUID .", 12716),   (". $GUID .", 12717),   (". $GUID .", 12719),
            (". $GUID .", 12720),   (". $GUID .", 12722),   (". $GUID .", 12723),   (". $GUID .", 12724),
            (". $GUID .", 12725),   (". $GUID .", 12727),   (". $GUID .", 12733),   (". $GUID .", 12738),
            (". $GUID .", 12747), /* RACE       */
            (". $GUID .", 13189), /* HORDE      */
            (". $GUID .", 13188), /* ALLIANCE   */
            (". $GUID .", 12751),   (". $GUID .", 12754),   (". $GUID .", 12755),   (". $GUID .", 12756),
            (". $GUID .", 12757),   (". $GUID .", 12778),   (". $GUID .", 12779),   (". $GUID .", 12800),
            (". $GUID .", 12801),   (". $GUID .", 12842),   (". $GUID .", 12848),   (". $GUID .", 12849),
            (". $GUID .", 12850),   (". $GUID .", 13165),   (". $GUID .", 13166);";
    }

    function SonsOfHordirTransfer($GUID) {
        return "INSERT INTO `character_queststatus_rewarded`(`guid`,`quest`) VALUES
            (". $GUID .", 12841),   (". $GUID .", 12843),   (". $GUID .", 12846),   (". $GUID .", 12851),
            (". $GUID .", 12856),   (". $GUID .", 12886),   (". $GUID .", 12900),   (". $GUID .", 12905),
            (". $GUID .", 12906),   (". $GUID .", 12907),   (". $GUID .", 12908),   (". $GUID .", 12915),
            (". $GUID .", 12921),   (". $GUID .", 12924),   (". $GUID .", 12969),   (". $GUID .", 12970),
            (". $GUID .", 12971),   (". $GUID .", 12972),   (". $GUID .", 12983),   (". $GUID .", 12996),
            (". $GUID .", 12997),   (". $GUID .", 13061),   (". $GUID .", 13062),   (". $GUID .", 13063),
            (". $GUID .", 13064);";
    }
?>