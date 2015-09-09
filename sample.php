<?php
                if (version_compare(phpversion(), '5.2.0', '<')) {
                        echo 'It looks like you have an invalid PHP version. Magento supports PHP 5.2.0 or newer';
                        exit;
                }
                error_reporting(E_ALL | E_STRICT);

                $mageFilename = getcwd() . '/app/Mage.php';

                if (!file_exists($mageFilename)) {
                        echo 'Mage file not found';
                        exit;
                }
                require $mageFilename;

                if (!Mage::isInstalled()) {
                        echo 'Application is not installed yet, please complete install wizard first.';
                        exit;
                }

                if (isset($_SERVER['MAGE_IS_DEVELOPER_MODE'])) {
                        Mage::setIsDeveloperMode(true);
                }


		$keyword = "";

                $URL = "https://www.googleapis.com/youtube/v3/search?part=id%2Csnippet&order=date&maxResults=30&q=$keyword&type=video&key=AIzaSyDGyODZV18Pf1zBuIdcE5esz8PXtaZtj1c";

                $JS = file_get_contents($URL);

                $json_o=json_decode($JS);
                $json_a=json_decode($JS,true);

                $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
                $connection->beginTransaction();

                $_query = "insert into youtubevideo (video_id, video_title) values ";
                $insert_values = array();

                for($i = 0; $i < 20; $i++)
                {

                        $id = $json_a[items][$i][id][videoId];
                        $title = $json_a[items][$i][snippet][title];              
                        $insert_values = array_merge($insert_values, video_id, video_title);
                }


                $_query = $_query.rtrim($_query_add, ",");
                $stmt = $connection->prepare ($_query);

                $connection->commit();
?>
