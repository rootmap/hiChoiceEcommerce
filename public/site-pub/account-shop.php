<?php
session_start();
include './include/config.php';
include './cms-admin/plugin/plugin.php';
$plugin = new cmsPlugin();
$table = "shop";
$table1="employee";
//echo md5("12345");exit();
include './cms-admin/class/login.php';
$logu = new loginClass();
if (isset($_POST['ShopAccount'])) {
    $failed="login.php";
    extract($_POST);
    if (!empty($shop_name)) {
        if ($obj->exists_multiple($table, array("email" => $email)) == 0) {
//            include('./cms-admin/class/uploadImage_Class.php');
//        $imgclassget = new image_class();
//        $shop_image = $imgclassget->upload_fiximage("./", "shop_image", "images_upload_" . time());
            $insert = array('email' => $email, 'password' => $logu->MakePassword($password), 'shop_name' => $shop_name, 'shop_image' => $shop_image, 'shop_address' => $shop_address, 'bank_name' => $bank_name, 'bank_account_no' => $bank_acc_no, 'bkash_mobile_number' => $bkash, 'dbbl_mobile_number' => $dbbl, 'paypal' => $paypal, 'contact_person_name' => $con_per_name, 'contact_number' => $contact_number, 'newsletter' => $newsletter, 'special_offers' => $special_offers, 'date' => date('Y-m-d'), 'status' => 1);
            if ($obj->insert($table, $insert) == 1) {
                //$plugin->Success("Successfully Saved Shop", $obj->filename());
            }if ($obj->exists_multiple($table1, array("username" => $username)) == 0) {
                $insert = array('username'=>$username, 'password' => $logu->MakePassword($password), 'date' => date('Y-m-d'), 'status' => 2);
                if ($obj->insert($table1, $insert) == 1) {
                 $plugin->Success("Successfully Saved", $obj->filename());
                }
            } 
            
            
            
            
            
            else {
                $plugin->Error("Failed", $failed);
            }
        } else {
            $plugin->Error("Failed, Already Exists.", $obj->filename());
        }
    } else {
        $plugin->Error("Fields is Empty", $obj->filename());
    }
}
?>
<!DOCTYPE HTML>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en-us"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie7" lang="en-us"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie8" lang="en-us"><![endif]-->
<!--[if gt IE 8]><html class="no-js ie9" lang="en-us"><![endif]-->
<html lang="en-us">

    <head>
        <meta charset="utf-8" />
        <title>Login - Monaco home page 1</title>
        <meta name="generator" content="PrestaShop" />
        <meta name="robots" content="index,follow" />
        <meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.ico?1478574343" />
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico?1478574343" />
        <link rel="stylesheet" href="css/v_9524_055d2884ba02eaca499b3d6c05c65baa_all.css" type="text/css" media="all" />
        <!--[if IE 8]> 
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> 
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script> <![endif]-->
    </head>

    <body id="authentication" class="authentication hide-left-column hide-right-column lang_en fullwidth">
        <div class="field-demo-wrap">
            <h2 class="field-demo-title">Theme Settings</h2>
            <div class="field-demo-option">
                <div class="cl-wrapper">
                    <div class="cl-container">
                        <div class="cl-table">
                            <div class="cl-tr cl-tr-mode-label">Mode Layout</div>
                            <div class="cl-tr cl-tr-mode">
                                <div class="cl-td-l">
                                    <input id="mode_box" type="radio" name="mode_css" value="box" />
                                    <label for="mode_box">Box</label>
                                </div>
                                <div class="cl-td-r">
                                    <input id="mode_full" type="radio" name="mode_css" value="wide" />
                                    <label for="mode_full">Wide</label>
                                </div>
                            </div>
                            <div class="cl-tr cl-tr-style-label">Theme color</div>
                            <div class="cl-tr cl-tr-style">
                                <div class="cl-td-l cl-td-layout cl-td-layout1"><a href="javascript:void(0)" id="444445_2fdab8" title="brown_red"><span class="tcbrown"></span><span class="tceb5f60"></span>Skin 1</a></div>
                                <div class="cl-td-r cl-td-layout cl-td-layout2"><a href="javascript:void(0)" id="c74747_e3c048" title="red_yellow"><span class="tcred"></span><span class="tcyellow"></span>Skin 2</a></div>
                            </div>
                            <div class="cl-tr cl-tr-style">
                                <div class="cl-td-l cl-td-layout cl-td-layout3"><a href="javascript:void(0)" id="2bbbd8_ffb502" title="blue_orange"><span class="tcblue2"></span><span class="tcorange"></span>Skin 3</a></div>
                                <div class="cl-td-r cl-td-layout cl-td-layout4"><a href="javascript:void(0)" id="333333_08bbb7" title="black_blue"><span class="tcblue3"></span><span class="tcblack"></span>Skin 4</a></div>
                            </div>
                            <div class="cl-tr cl-tr-style">
                                <div class="cl-td-l cl-td-layout cl-td-layout5"><a href="javascript:void(0)" id="5cc1b9_eb8278" title="blue_pink"><span class="tcpink"></span><span class="tcblue"></span>Skin 5</a></div>
                                <div class="cl-td-r cl-td-layout cl-td-layout6"><a href="javascript:void(0)" id="837a6b_a9b35d" title="gray_green"><span class="tcgreen"></span><span class="tcgray"></span>Skin 6</a></div>
                            </div>
                            <div class="label_chosen">
                                <div class="cl-tr cl-tr-style-label">Choose your colors</div>
                            </div>
                            <div class="cl-tr cl-tr-background">
                                <div class="cl-td-l">Background Color:</div>
                                <div class="cl-td-r">
                                    <div class="colorSelector cl-tool" id="backgroundColor">
                                        <div style="background-color: #1e1e21"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="cl-tr cl-tr-link">
                                <div class="cl-td-l">Active Color:</div>
                                <div class="cl-td-r">
                                    <div class="colorSelector cl-tool" id="hoverColor">
                                        <div style="background-color: #f2532f"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="cl-tr cl-row-reset"> <span class="cl-reset">Reset</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="control inactive">
                <a href="javascript:void(0)"></a>
            </div>
        </div>
        <div id="page">
            <div class="header-container">
                <header id="header">
<?php include './include/header.php'; ?>
                </header>
            </div>
            <div id="header_mobile_menu" class="navbar-inactive visible-sm visible-xs">
                <div class="container">
                    <div class="fieldmm-nav col-sm-12 col-xs-12"> <span class="brand">Menu list</span> <span id="fieldmm-button"><i class="icon-reorder"></i></span>
<?php include './include/mblnav.php'; ?>
                    </div>
                </div>
            </div>
            <div class="columns-container">
                <div id="columns" class="container">
                    <div id="slider_row" class="row"></div>
                    <div class="row">
                        <div class="container">
                            <div class="breadcrumb title_font clearfix"> <a class="home title_font" href="http://demo.fieldthemes.com/ps_monaco/home1/" title="Return to Home"><span class="title">Home</span></a> <span class="navigation-pipe"><i class="icon-chevron-right"></i></span> Authentication</div>
                        </div>
                        <div id="center_column" class="center_column col-xs-12 col-sm-12 col-md-12">
                            <div id="noSlide" style="display: block;">
                                <h1 class="page-heading">Create an account</h1>
                                <form action="" method="post" id="account-creation_form" class="std box">
                                    <div class="account_creation">
                                        <h3 class="page-subheading">Your Company information</h3>
                                        <p class="required"><sup>*</sup>Required field</p>
                                        <div class="col-md-4 col-md-offset-8"><?php echo $plugin->ShowMsg(); ?></div><br/>
                                        <div class="clearfix">

                                            <div class="required form-group">
                                                <label for="shop_name">Shop name <sup>*</sup></label>
                                                <input class="is_required validate form-control"  data-validate="isName" id="customer_firstname" name="shop_name" value="" type="text" autofocus required>
                                            </div>
                                            <div class="required form-group">
                                                <label for="customer_lastname">Shop Image <sup>*</sup></label>
                                                <input class=""  name="shop_image" type="file">
                                            </div>
                                            <div class="required form-group">
                                                <label for="email">Email <sup>*</sup></label>
                                                
                                                <input class="is_required validate form-control" data-validate="isEmail" id="email" name="email" value="<?php extract($_POST); echo $email_create;?>" type="email" required>
                                            </div>
                                            <div class="required form-group">
                                                <label for="shop_name">User Name <sup>*</sup></label>
                                                <input  class="is_required validate form-control" data-validate="isEmail" id="email" name="username" value="" type="text" required>
                                            </div>
                                            <div class="required password form-group form-error">
                                                <label for="passwd">Password <sup>*</sup></label>
                                                <input class="is_required validate form-control" data-validate="isPasswd" name="password" id="passwd" type="password" required> <span class="form_info">(Five characters minimum)</span>
                                            </div>
                                            <div class="required form-group">
                                                <label for="email">Shop Address <sup>*</sup></label>
                                                <!--<input class="is_required validate form-control" data-validate="isEmail" id="email" name="email" value="fakhrulislamtalwukder@gmail.com" type="email">-->
                                                <textarea class="is_required validate form-control" name="shop_address" data-validate="isName" id="customer_firstname" rows="4" cols="50" required></textarea>
                                            </div>
                                            <div class="required form-group">
                                                <label for="shop_name">Bank Name <sup>*</sup></label>
                                                <input  class="is_required validate form-control" data-validate="isName" id="customer_firstname" name="bank_name" value="" type="text" required>
                                            </div>
                                            <div class="required form-group">
                                                <label for="shop_name">Bank Account No <sup>*</sup></label>
                                                <input class="is_required validate form-control" data-validate="isName" id="customer_firstname" name="bank_acc_no" value="" type="text" required>
                                            </div>
                                            <div class="required form-group">
                                                <label for="shop_name">Bkash Mobile Number <sup>*</sup></label>
                                                <input class="is_required validate form-control" data-validate="isName" id="customer_firstname" name="bkash" value="" type="text" required>
                                            </div>
                                            <div class="required form-group">
                                                <label for="shop_name">DBBL Mobile Number <sup>*</sup></label>
                                                <input class="is_required validate form-control" data-validate="isName" id="customer_firstname" name="dbbl" value="" type="text" required>
                                            </div>
                                            <div class="required form-group">
                                                <label for="shop_name">Paypal <sup>*</sup></label>
                                                <input class="is_required validate form-control" data-validate="isName" id="customer_firstname" name="paypal" value="" type="text" required>
                                            </div>
                                            <div class="required form-group">
                                                <label for="shop_name">Contact Person Name <sup>*</sup></label>
                                                <input class="is_required validate form-control" data-validate="isName" id="customer_firstname" name="con_per_name" value="" type="text" required>
                                            </div>
                                            <div class="required form-group">
                                                <label for="shop_name">Contact Number <sup>*</sup></label>
                                                <input class="is_required validate form-control" data-validate="isName" id="customer_firstname" name="contact_number" value="" type="text" required>
                                            </div>

                                            <div class="checkbox">
                                                <div class="checker" id="uniform-newsletter"><span><input name="newsletter" id="newsletter" value="1" type="checkbox" required></span></div>
                                                <label for="newsletter">Sign up for our newsletter!</label>
                                            </div>
                                            <div class="checkbox">
                                                <div class="checker" id="uniform-optin"><span><input name="special_offers" id="optin" value="1" type="checkbox" required></span></div>
                                                <label for="optin">Receive special offers from our partners!</label>
                                            </div>
                                        </div>
                                        <div class="submit clearfix">
                                            <button type="submit" name="ShopAccount" id="submitAccount" class="btn btn-default button button-medium"> <span>Register<i class="icon-chevron-right right"></i></span> </button>
                                            <p class="pull-right required"><span><sup>*</sup>Required field</span></p>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Brands-block-slider">
                <div class="container">
                    <div id="fieldbrandslider" class="block horizontal_mode title_center">
                        <h4 class="title_block title_font"><a class="title_text" href="http://demo.fieldthemes.com/ps_monaco/home1/en/manufacturers">Our brands<span class="bd_title"></span></a></h4>
                        <div class="row">
                            <div id="fieldbrandslider-manufacturers" class="grid carousel-grid owl-carousel">
                                <div class="item">
                                    <a class="img-wrapper" href="http://demo.fieldthemes.com/ps_monaco/home1/en/2_manufacture-1" title="Manufacture 1"> <img class="img-responsive" src="images/2-field_manufacture.jpg" width="210" height="62" alt="Manufacture 1" /> </a>
                                </div>
                                <div class="item">
                                    <a class="img-wrapper" href="http://demo.fieldthemes.com/ps_monaco/home1/en/3_manufacture-2" title="Manufacture 2"> <img class="img-responsive" src="images/3-field_manufacture.jpg" width="210" height="62" alt="Manufacture 2" /> </a>
                                </div>
                                <div class="item">
                                    <a class="img-wrapper" href="http://demo.fieldthemes.com/ps_monaco/home1/en/4_manufacture-3" title="Manufacture 3"> <img class="img-responsive" src="images/4-field_manufacture.jpg" width="210" height="62" alt="Manufacture 3" /> </a>
                                </div>
                                <div class="item">
                                    <a class="img-wrapper" href="http://demo.fieldthemes.com/ps_monaco/home1/en/5_manufacture-4" title="Manufacture 4"> <img class="img-responsive" src="images/5-field_manufacture.jpg" width="210" height="62" alt="Manufacture 4" /> </a>
                                </div>
                                <div class="item">
                                    <a class="img-wrapper" href="http://demo.fieldthemes.com/ps_monaco/home1/en/6_manufacture-5" title="Manufacture 5"> <img class="img-responsive" src="images/6-field_manufacture.jpg" width="210" height="62" alt="Manufacture 5" /> </a>
                                </div>
                                <div class="item">
                                    <a class="img-wrapper" href="http://demo.fieldthemes.com/ps_monaco/home1/en/7_manufacture-6" title="Manufacture 6"> <img class="img-responsive" src="images/7-field_manufacture.jpg" width="210" height="62" alt="Manufacture 6" /> </a>
                                </div>
                                <div class="item">
                                    <a class="img-wrapper" href="http://demo.fieldthemes.com/ps_monaco/home1/en/8_manufacture-8" title="Manufacture 8"> <img class="img-responsive" src="images/8-field_manufacture.jpg" width="210" height="62" alt="Manufacture 8" /> </a>
                                </div>
                                <div class="item">
                                    <a class="img-wrapper" href="http://demo.fieldthemes.com/ps_monaco/home1/en/9_manufacture-9" title="Manufacture 9"> <img class="img-responsive" src="images/9-field_manufacture.jpg" width="210" height="62" alt="Manufacture 9" /> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-container">
                <div id="footer">
<?php include './include/footer.php'; ?>
                    <div class="container">
                        <div class="row"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="back-top"><a href="#" class="mypresta_scrollup hidden-phone"><i class="icon-chevron-up"></i></a></div>
        <div id="layer_compare" class="layer_box">
            <div class="layer_inner_box">
                <div class="layer_product clearfix">
                    <div class="product-image-container layer_compare_img"></div>
                    <div class="layer_product_info"> <span id="layer_compare_product_title" class="product-name"></span></div>
                </div>
                <div id="compare_add_success" class="success">Product successfully added to the product comparison!</div>
                <div id="compare_remove_success" class="success hidden">Product successfully removed from the product comparison!</div>
                <div class="button-container clearfix"> <a class="continue pull-left btn btn-default" rel="nofollow" href="javascript:;">Continue shopping</a> <a class="pull-right btn btn-default layer_compare_btn" rel="nofollow" title="Go to Compare" href="http://demo.fieldthemes.com/ps_monaco/home1/en/products-comparison">Go to Compare</a></div>
            </div>
        </div>
        <script type="text/javascript">
            /* <![CDATA[ */;
            var CUSTOMIZE_TEXTFIELD = 1;
            var FIELD_enableCountdownTimer = true;
            var FIELD_mainLayout = 'fullwidth';
            var FIELD_stickyCart = true;
            var FIELD_stickyMenu = true;
            var FIELD_stickySearch = true;
            var FancyboxI18nClose = 'Close';
            var FancyboxI18nNext = 'Next';
            var FancyboxI18nPrev = 'Previous';
            var LANG_RTL = '0';
            var added_to_wishlist = 'The product was successfully added to your wishlist.';
            var ajax_allowed = true;
            var ajaxsearch = true;
            var baseDir = 'http://demo.fieldthemes.com/ps_monaco/home1/';
            var baseUri = 'http://demo.fieldthemes.com/ps_monaco/home1/';
            var comparator_max_item = 3;
            var compare_add_text = 'Add to Compare';
            var compare_remove_text = 'Remove from Compare';
            var comparedProductsIds = [];
            var contentOnly = false;
            var countdownDay = 'Day';
            var countdownDays = 'Days';
            var countdownHour = 'Hour';
            var countdownHours = 'Hours';
            var countdownMinute = 'Min';
            var countdownMinutes = 'Mins';
            var countdownSecond = 'Sec';
            var countdownSeconds = 'Secs';
            var countries = {
                "21": {
                    "id_country": "21",
                    "id_lang": "1",
                    "name": "United States",
                    "id_zone": "2",
                    "id_currency": "0",
                    "iso_code": "US",
                    "call_prefix": "1",
                    "active": "1",
                    "contains_states": "1",
                    "need_identification_number": "0",
                    "need_zip_code": "1",
                    "zip_code_format": "NNNNN",
                    "display_tax_label": "0",
                    "country": "United States",
                    "zone": "North America",
                    "states": [{
                            "id_state": "1",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Alabama",
                            "iso_code": "AL",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "2",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Alaska",
                            "iso_code": "AK",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "3",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Arizona",
                            "iso_code": "AZ",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "4",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Arkansas",
                            "iso_code": "AR",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "5",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "California",
                            "iso_code": "CA",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "6",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Colorado",
                            "iso_code": "CO",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "7",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Connecticut",
                            "iso_code": "CT",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "8",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Delaware",
                            "iso_code": "DE",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "53",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "District of Columbia",
                            "iso_code": "DC",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "9",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Florida",
                            "iso_code": "FL",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "10",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Georgia",
                            "iso_code": "GA",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "11",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Hawaii",
                            "iso_code": "HI",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "12",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Idaho",
                            "iso_code": "ID",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "13",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Illinois",
                            "iso_code": "IL",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "14",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Indiana",
                            "iso_code": "IN",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "15",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Iowa",
                            "iso_code": "IA",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "16",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Kansas",
                            "iso_code": "KS",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "17",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Kentucky",
                            "iso_code": "KY",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "18",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Louisiana",
                            "iso_code": "LA",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "19",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Maine",
                            "iso_code": "ME",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "20",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Maryland",
                            "iso_code": "MD",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "21",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Massachusetts",
                            "iso_code": "MA",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "22",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Michigan",
                            "iso_code": "MI",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "23",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Minnesota",
                            "iso_code": "MN",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "24",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Mississippi",
                            "iso_code": "MS",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "25",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Missouri",
                            "iso_code": "MO",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "26",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Montana",
                            "iso_code": "MT",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "27",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Nebraska",
                            "iso_code": "NE",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "28",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Nevada",
                            "iso_code": "NV",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "29",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "New Hampshire",
                            "iso_code": "NH",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "30",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "New Jersey",
                            "iso_code": "NJ",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "31",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "New Mexico",
                            "iso_code": "NM",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "32",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "New York",
                            "iso_code": "NY",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "33",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "North Carolina",
                            "iso_code": "NC",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "34",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "North Dakota",
                            "iso_code": "ND",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "35",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Ohio",
                            "iso_code": "OH",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "36",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Oklahoma",
                            "iso_code": "OK",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "37",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Oregon",
                            "iso_code": "OR",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "38",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Pennsylvania",
                            "iso_code": "PA",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "51",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Puerto Rico",
                            "iso_code": "PR",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "39",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Rhode Island",
                            "iso_code": "RI",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "40",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "South Carolina",
                            "iso_code": "SC",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "41",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "South Dakota",
                            "iso_code": "SD",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "42",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Tennessee",
                            "iso_code": "TN",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "43",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Texas",
                            "iso_code": "TX",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "52",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "US Virgin Islands",
                            "iso_code": "VI",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "44",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Utah",
                            "iso_code": "UT",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "45",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Vermont",
                            "iso_code": "VT",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "46",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Virginia",
                            "iso_code": "VA",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "47",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Washington",
                            "iso_code": "WA",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "48",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "West Virginia",
                            "iso_code": "WV",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "49",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Wisconsin",
                            "iso_code": "WI",
                            "tax_behavior": "0",
                            "active": "1"
                        }, {
                            "id_state": "50",
                            "id_country": "21",
                            "id_zone": "2",
                            "name": "Wyoming",
                            "iso_code": "WY",
                            "tax_behavior": "0",
                            "active": "1"
                        }]
                }
            };
            var currency = {
                "id": 1,
                "name": "Dollar",
                "iso_code": "USD",
                "iso_code_num": "840",
                "sign": "$",
                "blank": "0",
                "conversion_rate": "1.000000",
                "deleted": "0",
                "format": "1",
                "decimals": "1",
                "active": "1",
                "prefix": "$ ",
                "suffix": "",
                "id_shop_list": null,
                "force_id": false
            };
            var currencyBlank = 0;
            var currencyFormat = 1;
            var currencyRate = 1;
            var currencySign = '$';
            var customizationIdMessage = 'Customization #';
            var delete_txt = 'Delete';
            var displayList = false;
            var email_create = false;
            var fieldblocksearch_type = 'top';
            var fieldbs_autoscroll = '5000';
            var fieldbs_maxitem = '5';
            var fieldbs_minitem = '2';
            var fieldbs_navigation = false;
            var fieldbs_pagination = false;
            var fieldbs_pauseonhover = false;
            var freeProductTranslation = 'Free!';
            var freeShippingTranslation = 'Free shipping!';
            var generated_date = 1480875017;
            var hasDeliveryAddress = false;
            var highDPI = false;
            var idSelectedCountry = false;
            var idSelectedCountryInvoice = false;
            var idSelectedState = false;
            var idSelectedStateInvoice = false;
            var id_lang = 1;
            var img_dir = 'http://demo.fieldthemes.com/ps_monaco/home1/themes/monaco/img/';
            var instantsearch = false;
            var isGuest = 0;
            var isLogged = 0;
            var isMobile = false;
            var langIso = 'en-us';
            var loggin_required = 'You must be logged in to manage your wishlist.';
            var max_item = 'You cannot add more than 3 product(s) to the product Comparison';
            var min_item = 'Please select at least one product';
            var mywishlist_url = 'http://demo.fieldthemes.com/ps_monaco/home1/en/module/blockwishlist/mywishlist';
            var page_name = 'authentication';
            var placeholder_blocknewsletter = 'Your e-mail';
            var priceDisplayMethod = 1;
            var priceDisplayPrecision = 2;
            var quickView = true;
            var removingLinkText = 'remove this product from my cart';
            var roundMode = 2;
            var search_url = 'http://demo.fieldthemes.com/ps_monaco/home1/en/search';
            var static_token = 'cf034011c60a29a745742ca00eb50882';
            var toBeDetermined = 'To be determined';
            var token = '1781ddff19ab1fd7c75d1f91a7f58d3f';
            var usingSecureMode = false;
            var wishlistProductsIds = false; /* ]]> */
        </script>
        <script type="text/javascript" src="js/v_4_e7928e80154366e778fbeb3f3e4ac066.js"></script>
        <script type="text/javascript" src="js/jquery.elevatezoom.min.js"></script>
        <script type="text/javascript">
            /* <![CDATA[ */;
            var zoom_type = 'window';
            var zoom_fade_in = 400;
            var zoom_fade_out = 550;
            var zoom_cursor_type = 'default';
            var zoom_window_pos = 1;
            var zoom_scroll = true;
            var zoom_easing = true;
            var zoom_tint = true;
            var zoom_tint_color = '#333';
            var zoom_tint_opacity = 0.4;
            var zoom_lens_shape = 'round';
            var zoom_lens_size = 420;
            ;

            function applyElevateZoom() {
                var src = $('.thickbox.shown').attr('href');
                var bigimage = $('.fancybox.shown').attr('href');
                $('#bigpic').elevateZoom({
                    zoomType: zoom_type,
                    cursor: zoom_cursor_type,
                    zoomWindowFadeIn: zoom_fade_in,
                    zoomWindowFadeOut: zoom_fade_out,
                    zoomWindowPosition: zoom_window_pos,
                    scrollZoom: zoom_scroll,
                    easing: zoom_easing,
                    tint: zoom_tint,
                    tintColour: zoom_tint_color,
                    tintOpacity: zoom_tint_opacity,
                    lensShape: zoom_lens_shape,
                    lensSize: zoom_lens_size,
                    zoomImage: bigimage,
                    borderSize: 1,
                    borderColour: '#d4d4d4',
                    zoomWindowWidth: 535,
                    zoomWindowHeight: 535,
                    zoomLevel: 0.5,
                    lensBorderSize: 0
                });
            }
            $(document).ready(function () {
                applyElevateZoom();
                $('#color_to_pick_list').click(function () {
                    restartElevateZoom();
                });
                $('#color_to_pick_list').hover(function () {
                    restartElevateZoom();
                });
                $('#views_block li a').hover(function () {
                    restartElevateZoom();
                });
            });

            function restartElevateZoom() {
                $(".zoomContainer").remove();
                applyElevateZoom();
            }
            ;
            ;
            var input = $("#search_query_top");
            $('document').ready(function () {
                var width_ac_results = input.outerWidth();
                Input_focus()
                $("#search_query_top").autocomplete('http://demo.fieldthemes.com/ps_monaco/home1/en/search', {
                    minChars: 3,
                    max: 10,
                    width: (width_ac_results > 0 ? width_ac_results : 500),
                    selectFirst: false,
                    scroll: true,
                    dataType: "json",
                    formatItem: function (data, i, max, value, term) {
                        return value;
                    },
                    parse: function (data) {
                        var mytab = new Array();
                        for (var i = 0; i < data.length; i++)
                            mytab[mytab.length] = {
                                data: data[i],
                                value: '<img alt="' + data[i].pname + '" src="' + data[i].image + '"><div class="right-search"><h5>' + data[i].pname + '</h5><span class="price">' + data[i].dprice + '</span></div> '
                            };
                        return mytab;
                    },
                    extraParams: {
                        ajaxSearch: 1,
                        id_lang: 1,
                        category_filter: $("#category_filter").val()
                    }
                }).result(function (event, data, formatted) {
                    $('#search_query_top').val(data.pname);
                    document.location.href = data.product_link;
                });
                $("#category_filter").change(function () {
                    $(".ac_results").remove();
                    $("#search_query_top").trigger('unautocomplete');
                    Input_focus()
                    $("#search_query_top").autocomplete('http://demo.fieldthemes.com/ps_monaco/home1/en/search', {
                        minChars: 3,
                        max: 10,
                        width: (width_ac_results > 0 ? width_ac_results : 500),
                        selectFirst: false,
                        scroll: true,
                        dataType: "json",
                        formatItem: function (data, i, max, value, term) {
                            return value;
                        },
                        parse: function (data) {
                            var mytab = new Array();
                            for (var i = 0; i < data.length; i++)
                                mytab[mytab.length] = {
                                    data: data[i],
                                    value: '<img alt="' + data[i].pname + '" src="' + data[i].image + '"><div class="right-search"><h5>' + data[i].pname + '</h5><span class="price">' + data[i].dprice + '</span></div> '
                                };
                            return mytab;
                        },
                        extraParams: {
                            ajaxSearch: 1,
                            id_lang: 1,
                            category_filter: $("#category_filter").val()
                        }
                    }).result(function (event, data, formatted) {
                        $('#search_query_top').val(data.pname);
                        document.location.href = data.product_link;
                    });
                });
            });

            function Input_focus() {
                $('#search_query_top').on('focus', function () {
                    var width_ac_results = input.outerWidth();
                    var $this = $(this);
                    if ($this.val() == 'Enter your keyword ...') {
                        $this.val('');
                        $('.btn.button-search').addClass('active');
                    }
                }).on('blur', function () {
                    var $this = $(this);
                    if ($this.val() == '') {
                        $this.val('Enter your keyword ...');
                        $('.btn.button-search').removeClass('active');
                    }
                });
            }
            ; /* ]]> */
        </script>
    </body>

</html>