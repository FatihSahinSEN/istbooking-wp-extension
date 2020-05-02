<?php

/*
Plugin Name: Sistem Otel - BookEngine Widget
Plugin URI: https://www.sistemotel.com/Booking-Engine
Description: Istbooking.com Üzerinden Otelinize Rezervasyon motoru sağlar. Bu Rezervasyon Motoru Yönetimi WordPress Üzerinden Yönetilmez, Sadece Sitenize Book Now Buttonu Eklemenizde Yararlı Olur..
Version: 1.0.1
Author: Fatih Şahin ŞEN
Author URI: https://github.com/FatihSahinSEN
License: GNU
*/
define("_SISTEMOTELBOOKENGINE",true);
global $IstUrl, $IstDir, $IstOpts;
$IstUrl = plugin_dir_url(__FILE__);
$IstDir = dirname(__FILE__);
$IstOpts = "SistemOtelBookEngine";


/**
 * BookEngine Menüsünü Admin Paneline Ekledik.
 */
add_action('admin_menu', 'SistemOtelBookEngineAdminMenu');
/**
 * Gerekli CSS ve JS Dosyalarını Entegre Ettik
 */
add_action('admin_enqueue_scripts', 'SistemOtelBookEngineAdminStyle');
/**
 * ShortCode Oluşturduk
 */
add_shortcode( 'SistemOtelWidget', 'SistemOtelBookEngineFrontEndSet');

/**
 * Admin Menu Function
 */
if(!function_exists("SistemOtelBookEngineAdminMenu")) {
    function SistemOtelBookEngineAdminMenu()
    {
        add_menu_page(
            'Sistem Otel',
            'Book Engine',
            'manage_options',
            'book-engine',
            'SistemOtelBookEngineThemeSelect'
        );
        add_submenu_page(
            'book-engine',
            'BookEngine - Mobile',
            'Mobile Dizayn',
            "manage_options",
            'book-engine-mobile',
            'SistemOtelBookEngineThemeSelectMobile'
        );
        add_submenu_page(
            'book-engine',
            'Sistem Otel - CSS & JS',
            'CSS & JS',
            "manage_options",
            'book-engine-style',
            'SistemOtelBookEngineStyle'
        );
    }
}

/**
 * Admin Panel CSS ve JS Loader
 */
if(!function_exists("SistemOtelBookEngineAdminStyle")) {
    function SistemOtelBookEngineAdminStyle()
    {
        global $IstUrl;
        wp_enqueue_style('book-engine-admin-style', $IstUrl.'admin/css/rgbaColorPicker.css');
        wp_enqueue_script('book-engine-admin-script', $IstUrl.'admin/js/rgbaColorPicker.js');
        wp_enqueue_script('book-engine-admin-script2', $IstUrl.'admin/js/ui.js');
    }
}

/**
 * CREATE
 * WordPress Sistem Entegrasyonu
 * add_options düzenlenmiş hali..
 * SistemOtelBookEngineGetOptions ()
 *  - Methodu Tarafından Kullanılmaktadır..
 */
if(!function_exists("SistemOtelBookEngineCreateOptions")) {
    function SistemOtelBookEngineCreateOptions(){
        global $IstOpts;
        $data = array(
            "web-theme" => "YTozNTp7czo2OiJ0ZXN0ZXIiO3M6NToiQmV5YXoiO3M6NToiZHV6ZW4iO3M6NToiWWF0YXkiO3M6MTA6ImFya2FfY29sb3IiO3M6MTU6InJnYmEoMCwwLDAsMC40KSI7czo5OiJ5YXppX3NpemUiO3M6NDoiMjBweCI7czoxMDoieWF6aV9jb2xvciI7czo3OiIjRkZGRkZGIjtzOjEyOiJidXR0b25fY29sb3IiO3M6NzoiI0ZGMDAwMCI7czoxMToiYnV0dG9uX3NpemUiO3M6NDoiMjBweCI7czoxNjoiYnV0dG9ueWF6aV9jb2xvciI7czo3OiIjRkZGRkZGIjtzOjY6ImJvcmRlciI7czowOiIiO3M6MTY6ImlucHV0X2Fya2FfY29sb3IiO3M6NzoiIzMzOTlDQyI7czoxNjoiaW5wdXRfZm9udF9jb2xvciI7czo3OiIjMDBDQzAwIjtzOjE3OiJzZWxlY3RfYXJrYV9jb2xvciI7czo3OiIjOTk2NkNDIjtzOjE3OiJzZWxlY3RfZm9udF9jb2xvciI7czo3OiIjNjZDQ0ZGIjtzOjE3OiJtdWx0aV9ib3JkZXJfc2l6ZSI7czozOiIxcHgiO3M6MTI6Im11bHRpX2JvcmRlciI7czo3OiIjMDAwMDAwIjtzOjEwOiJmb3JtX3dpZHRoIjtzOjQ6IjEwMCUiO3M6MTE6ImZvcm1faGVpZ2h0IjtzOjU6IjEzMHB4IjtzOjEyOiJidXR0b25fd2lkdGgiO3M6NToiMjAwcHgiO3M6MTM6ImJ1dHRvbl9oZWlnaHQiO3M6NDoiNTBweCI7czoxMToiaW5wdXRfd2lkdGgiO3M6NToiMTIwcHgiO3M6MTI6InNlbGVjdF93aWR0aCI7czo0OiI3MHB4IjtzOjExOiJmb3JtX21hcmdpbiI7czowOiIiO3M6MTI6ImZvcm1fcGFkZGluZyI7czo0OiIzMHB4IjtzOjEyOiJpbnB1dF9tYXJnaW4iO3M6OToiMTBweCAyMHB4IjtzOjEzOiJpbnB1dF9wYWRkaW5nIjtzOjM6IjVweCI7czoxMzoic2VsZWN0X21hcmdpbiI7czo5OiIxMHB4IDIwcHgiO3M6MTQ6InNlbGVjdF9wYWRkaW5nIjtzOjM6IjVweCI7czoxMToieWF6aV9tYXJnaW4iO3M6ODoiMHB4IDI1cHgiO3M6MTI6InlhemlfcGFkZGluZyI7czowOiIiO3M6MTQ6ImJ1dHRvbl9wYWRkaW5nIjtzOjA6IiI7czoxMzoiYnV0dG9uX21hcmdpbiI7czo4OiIxMHB4IDBweCI7czoxMToiZm9ybV9yYWRpdXMiO3M6MDoiIjtzOjEyOiJpbnB1dF9yYWRpdXMiO3M6MzoiNXB4IjtzOjEzOiJzZWxlY3RfcmFkaXVzIjtzOjM6IjVweCI7czoxMzoiYnV0dG9uX3JhZGl1cyI7czozOiI1cHgiO30=",
            "mobile-theme" => "YTozNTp7czo2OiJ0ZXN0ZXIiO3M6NToiQmV5YXoiO3M6NToiZHV6ZW4iO3M6NToiRGlrZXkiO3M6MTA6ImFya2FfY29sb3IiO3M6MTU6InJnYmEoMCwwLDAsMC41KSI7czo5OiJ5YXppX3NpemUiO3M6NDoiMjBweCI7czoxMDoieWF6aV9jb2xvciI7czo3OiIjMDAwMDAwIjtzOjEyOiJidXR0b25fY29sb3IiO3M6NzoiI0ZGMDAwMCI7czoxMToiYnV0dG9uX3NpemUiO3M6NDoiMjBweCI7czoxNjoiYnV0dG9ueWF6aV9jb2xvciI7czo3OiIjRkZGRkZGIjtzOjY6ImJvcmRlciI7czo3OiIjRkZGRkZGIjtzOjE2OiJpbnB1dF9hcmthX2NvbG9yIjtzOjc6IiNGRjMzNjYiO3M6MTY6ImlucHV0X2ZvbnRfY29sb3IiO3M6NzoiIzAwMDBGRiI7czoxNzoic2VsZWN0X2Fya2FfY29sb3IiO3M6NzoiIzY2RkZDQyI7czoxNzoic2VsZWN0X2ZvbnRfY29sb3IiO3M6NzoiI0ZGMzNGRiI7czoxNzoibXVsdGlfYm9yZGVyX3NpemUiO3M6MzoiMXB4IjtzOjEyOiJtdWx0aV9ib3JkZXIiO3M6NzoiIzAwMDAwMCI7czoxMDoiZm9ybV93aWR0aCI7czo0OiIxMDAlIjtzOjExOiJmb3JtX2hlaWdodCI7czo1OiIzNTBweCI7czoxMjoiYnV0dG9uX3dpZHRoIjtzOjQ6IjEwMCUiO3M6MTM6ImJ1dHRvbl9oZWlnaHQiO3M6MDoiIjtzOjExOiJpbnB1dF93aWR0aCI7czo1OiIxNTBweCI7czoxMjoic2VsZWN0X3dpZHRoIjtzOjU6IjEwMHB4IjtzOjExOiJmb3JtX21hcmdpbiI7czowOiIiO3M6MTI6ImZvcm1fcGFkZGluZyI7czo0OiIyMHB4IjtzOjEyOiJpbnB1dF9tYXJnaW4iO3M6MzoiMHB4IjtzOjEzOiJpbnB1dF9wYWRkaW5nIjtzOjM6IjVweCI7czoxMzoic2VsZWN0X21hcmdpbiI7czozOiIwcHgiO3M6MTQ6InNlbGVjdF9wYWRkaW5nIjtzOjM6IjVweCI7czoxMToieWF6aV9tYXJnaW4iO3M6MzoiMHB4IjtzOjEyOiJ5YXppX3BhZGRpbmciO3M6MzoiNXB4IjtzOjE0OiJidXR0b25fcGFkZGluZyI7czo0OiIxNXB4IjtzOjEzOiJidXR0b25fbWFyZ2luIjtzOjM6IjVweCI7czoxMToiZm9ybV9yYWRpdXMiO3M6MDoiIjtzOjEyOiJpbnB1dF9yYWRpdXMiO3M6MzoiNXB4IjtzOjEzOiJzZWxlY3RfcmFkaXVzIjtzOjM6IjVweCI7czoxMzoiYnV0dG9uX3JhZGl1cyI7czozOiI1cHgiO30=",
            "css" => "",
            "javascript" => "",
            "mobile-css" => "",
            "mobile-javascript" => ""
        );
        add_option($IstOpts, $data, "Sistem Otel Book Engine Widgets", true);
        return $data;
    }
}

/**
 * UPDATE
 * WordPress Sistem Entegrasyonu
 * update_options düzenlenmiş hali.
 * Database İşlemlerini Güncellemek için kullanılır.
 */

if(!function_exists("SistemOtelBookEngineUpdateOptions")) {
    function SistemOtelBookEngineUpdateOptions($theme,$style){
        global $IstOpts;
        $data=SistemOtelBookEngineGetOptions();
        if($theme){
            if($theme["web-theme"]){
                $data["web-theme"] = base64_encode(serialize($theme["web-theme"]));
            }else{
                $data["mobile-theme"] = base64_encode(serialize($theme["mobile-theme"]));
            }
        }
        if($style){
            $data["css"] = base64_encode($style["css"]);
            $data["mobile-css"] = base64_encode($style["mobile-css"]);
            $data["javascript"] = base64_encode($style["javascript"]);
            $data["mobile-javascript"] = base64_encode($style["mobile-javascript"]);
        }
        if($theme OR $style){
            update_option($IstOpts, $data, true);
        }else{
            return false;
        }

    }
}

/**
 * GET
 * WordPress Sistem Entegrasyonu
 * get_options düzenlenmiş hali
 * Database üzerinden veri kontrolu
 *  - yapılır veriler mevcut değilse yenisi oluşturulur
 *  - Varolan veya Yeni oluşturulan değer geri döndürülür.
 */
if(!function_exists("SistemOtelBookEngineGetOptions")) {
    function SistemOtelBookEngineGetOptions(){
        global $IstOpts;
        $veri=get_option($IstOpts);
        if($veri){
            return $veri;
        }else{
            return SistemOtelBookEngineCreateOptions();
        }
    }
}


/**
 * Page : BookEngine
 * Sitede Gösterilecek Form İçin
 * Tema Seçim işlemi Yapılır.
 * Seçilen Tema Database üzerinde Update Edilir.
 * Desktop Style Creator
 */
if(!function_exists("SistemOtelBookEngineThemeSelect")){
    function SistemOtelBookEngineThemeSelect(){

        echo  '<h1>Sistem Otel - BookEngine Widget</h1>';
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $ds["web-theme"]=$_POST;
            $ds["mobile-theme"]=false;
            SistemOtelBookEngineUpdateOptions($ds,false);
        }

        $data=SistemOtelBookEngineGetOptions();
        $veri=unserialize(base64_decode($data["web-theme"]));
        if($veri["tester"]=="siyah") { $siyah=" checked";$beyaz=""; }else{ $beyaz=" checked";$siyah=""; }
        if($veri["duzen"]=="Yatay") { $yatay=" checked";$dikey=""; }else{ $dikey=" checked";$yatay=""; }
        ?>
        <div style="display: flex;justify-content: space-between">
        <div style="float: left;">
        <form method="post">
        <table class="form-table card" style="width:100%;">
            <thead>
            <tr style="border-bottom: 1px solid #ddd;"><td colspan="2"><b>Sayfa Düzen</b></td></tr>
            <tr style="">
                <th style="text-align: center">Test Alanı:</th>
                <th><input type="radio" id="siyah" class="rd" name="tester" value="Siyah" <?php echo $siyah; ?>>
                    <label for="siyah">Siyah</label>  -  
                    <input type="radio" id="beyaz" class="rd" name="tester" value="Beyaz" <?php echo $beyaz; ?>>
                    <label for="beyaz">Beyaz</label>
                </th>
            </tr>
            <tr>
                <th style="text-align: center">Form Düzeni</th>
                <th><input type="radio" id="Yatay" class="rd" name="duzen" value="Yatay" <?php echo $yatay; ?>>
                    <label for="Yatay">Yatay</label>  -  
                    <input type="radio" id="Dikey" class="rd" name="duzen" value="Dikey" <?php echo $dikey; ?>>
                    <label for="Dikey">Dikey</label>
                </th>
            </tr>
            </thead>
            <tr style="border-bottom: 1px solid #ddd;"><td colspan="2"><b>Renk & Boyut</b></td></tr>
                <tr>
                    <td style="text-align: center"><label for="arka_color">Arkaplan (Renk):</label></td>
                    <td><input name="arka_color" type="text" id="arka_color" class="color" value="<?php echo $veri["arka_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="yazi_color">Yazı (Boyut)(Renk):</label></td>
                    <td>
                        <input name="yazi_size" type="text" id="yazi_size" style="width:90px" value="<?php echo $veri["yazi_size"]; ?>">
                        <input name="yazi_color" type="text" id="yazi_color" style="width:90px" class="color" value="<?php echo $veri["yazi_color"]; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="button_color">Button (Boyut)(Renk):</label></td>

                    <td>
                        <input name="button_color" type="text" id="button_color" class="color" value="<?php echo $veri["button_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="buttonyazi_color">Button Yazı (Renk):</label></td>
                    <td><input name="button_size" type="text" id="button_size" style="width:90px" value="<?php echo $veri["button_size"]; ?>">
                        <input name="buttonyazi_color" type="text" id="buttonyazi_color" style="width:90px" class="color" value="<?php echo $veri["buttonyazi_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="border">Kenarlık (Renk):</label></td>
                    <td><input name="border" type="text" id="border" class="color" value="<?php echo $veri["border"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="input_arka_color">Input Arkaplan (Renk):</label></td>
                    <td><input name="input_arka_color" type="text" id="input_arka_color" class="color" value="<?php echo $veri["input_arka_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="input_font_color">Input Yazı (Renk):</label></td>
                    <td><input name="input_font_color" type="text" id="input_font_color" class="color" value="<?php echo $veri["input_font_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="select_arka_color">Select Arkaplan (Renk):</label></td>
                    <td><input name="select_arka_color" type="text" id="select_arka_color" class="color" value="<?php echo $veri["select_arka_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="select_font_color">Select Yazı (Renk):</label></td>
                    <td><input name="select_font_color" type="text" id="select_font_color" class="color" value="<?php echo $veri["select_font_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="multi_border">Select,Input,Button Border (Renk):</label></td>
                    <td>
                        <input name="multi_border_size" type="text" id="multi_border_size" style="width: 90px;" value="<?php echo $veri["multi_border_size"]; ?>">
                        <input name="multi_border" type="text" id="multi_border" class="color"  style="width: 90px;" value="<?php echo $veri["multi_border"]; ?>">

                    </td>
                </tr>
            <tr style="border-bottom: 1px solid #ddd;"><td colspan="2"><b>Genişlik & Yükseklik</b></td></tr>
                <tr>
                    <td>
                        <label for="form_width">
                            Form ( Genişlik ) :
                            <input name="form_width" type="text" id="form_width" value="<?php echo $veri["form_width"]; ?>"  style="width: 100px;" />
                        </label>
                    </td>
                    <td>
                        <label for="form_height">
                            Form ( Yükseklik ) :
                            <input name="form_height" type="text" id="form_height" value="<?php echo $veri["form_height"]; ?>" style="width: 100px;" />
                        </label>
                    </td>
                </tr>
            <tr>
                <td>
                    <label for="button_width">
                        Button (Genişlik):
                        <input name="button_width" type="text" id="button_width" value="<?php echo $veri["button_width"]; ?>" style="width: 100px;" />
                    </label>
                </td>
                <td>
                    <label for="button_height">
                        Button (Yükseklik):
                        <input name="button_height" type="text" id="button_height" value="<?php echo $veri["button_height"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="input_width">
                        Input ( Genişlik ) :
                        <input name="input_width" type="text" id="input_width" value="<?php echo $veri["input_width"]; ?>" style="width: 100px;" />
                    </label>
                </td>
                <td>
                    <label for="select_width">
                        Select ( Genişlik ) :
                        <input name="select_width" type="text" id="select_width" value="<?php echo $veri["select_width"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid #ddd;"><td colspan="2"><b>Margin & Padding</b></td></tr>
            <tr>
                <td>
                    <label for="form_margin">
                         Form ( Margin ) :
                        <input name="form_margin" type="text" id="form_margin" value="<?php echo $veri["form_margin"]; ?>" style="width: 110px;" />
                    </label>
                </td>
                <td>
                    <label for="form_padding">
                        Form ( Padding ) :
                        <input name="form_padding" type="text" id="form_padding" value="<?php echo $veri["form_padding"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="input_margin">
                         Input ( Margin ) :
                        <input name="input_margin" type="text" id="input_margin" value="<?php echo $veri["input_margin"]; ?>" style="width: 110px;" />
                    </label>
                </td>
                <td>
                    <label for="input_padding">
                        Input ( Padding ) :
                        <input name="input_padding" type="text" id="input_padding" value="<?php echo $veri["input_padding"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="select_margin">
                         Select ( Margin ) :
                        <input name="select_margin" type="text" id="select_margin" value="<?php echo $veri["select_margin"]; ?>" style="width: 110px;" />
                    </label>
                </td>
                <td>
                    <label for="select_padding">
                        Select ( Padding ) :
                        <input name="select_padding" type="text" id="select_padding" value="<?php echo $veri["select_padding"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="yazi_margin">
                         Yazilar ( Margin ) :
                        <input name="yazi_margin" type="text" id="yazi_margin" value="<?php echo $veri["yazi_margin"]; ?>" style="width: 110px;" />
                    </label>
                </td>
                <td>
                    <label for="yazi_padding">
                        Yazilar ( Padding ) :
                        <input name="yazi_padding" type="text" id="yazi_padding" value="<?php echo $veri["yazi_padding"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="button_padding">
                        Button ( Padding ):
                        <input name="button_padding" type="text" id="button_padding" value="<?php echo $veri["button_padding"]; ?>" style="width: 100px;" />
                    </label>
                </td>
                <td>
                    <label for="button_margin">
                        Button ( Margin ):
                        <input name="button_margin" type="text" id="button_margin" value="<?php echo $veri["button_margin"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid #ddd;"><td colspan="2"><b>Radius</b></td></tr>
            <tr>
                <td colspan="2">
                    <label for="form_radius">
                        Form:
                        <input name="form_radius" type="text" id="form_radius" value="<?php echo $veri["form_radius"]; ?>" style="width: 60px;" />
                    </label>
                    <label for="input_radius">
                        Input:
                        <input name="input_radius" type="text" id="input_radius" value="<?php echo $veri["input_radius"]; ?>" style="width: 60px;" />
                    </label>
                    <label for="select_radius">
                        Select:
                        <input name="select_radius" type="text" id="select_radius" value="<?php echo $veri["select_radius"]; ?>" style="width: 60px;" />
                    </label>
                    <label for="button_radius">
                        Button:
                        <input name="button_radius" type="text" id="button_radius" value="<?php echo $veri["button_radius"]; ?>" style="width: 60px;" />
                    </label>
                </td>

            </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Kaydet"/></td>
                </tr>
            </tbody></table>
        </form>
        </div>
            <style>#SistemOtel input,
                #SistemOtel label,
                #SistemOtel select,
                #SistemOtel button,
                #SistemOtel textarea
                {
                    margin:0;
                    border:0;
                    padding:0;
                    display:inline-block;
                    vertical-align:middle;
                    white-space:normal;
                    background:none;
                    line-height:1;
                }
                #SistemOtel select{
                    text-align: center;
                }
            </style>
            <div id="tester" style="position: -webkit-sticky; /* Safari */position: sticky;top: 0;height:100vh">
                <h1 style="text-align: center;color:#fff;">Test Alanı</h1>
                <?php
                    $data=array();
                    echo SistemOtelBookEngineAdminForm($data);
                ?>
            </div>

        </div>
        <?php

    }
}

/**
 * Page : BookEngine - Mobile
 * Sitede Gösterilecek Mobil Form İçin
 * Tema Seçim işlemi Yapılır.
 * Seçilen Tema Database üzerinde Update Edilir.
 * Desktop Style Creator
 */
if(!function_exists("SistemOtelBookEngineThemeSelectMobile")){
    function SistemOtelBookEngineThemeSelectMobile(){

        echo  '<h1>Sistem Otel - BookEngine Mobile Widget</h1>';
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $ds["web-theme"]=false;
            $ds["mobile-theme"]=$_POST;
            SistemOtelBookEngineUpdateOptions($ds,false);
        }

        $data=SistemOtelBookEngineGetOptions();
        $veri=unserialize(base64_decode($data["mobile-theme"]));
        if($veri["tester"]=="siyah") { $siyah=" checked";$beyaz=""; }else{ $beyaz=" checked";$siyah=""; }
        if($veri["duzen"]=="Yatay") { $yatay=" checked";$dikey=""; }else{ $dikey=" checked";$yatay=""; }
        global $IstUrl;
        ?>
        <div style="display: flex">
        <div style="float: left;">
        <form method="post">
        <table class="form-table card" style="width:100%;">
            <thead>
            <tr style="border-bottom: 1px solid #ddd;"><td colspan="2"><b>Sayfa Düzen</b></td></tr>
            <tr style="">
                <th style="text-align: center">Test Alanı:</th>
                <th><input type="radio" id="mobil-siyah" class="rd" name="tester" value="Siyah" <?php echo $siyah; ?>>
                    <label for="mobil-siyah">Siyah</label>  -  
                    <input type="radio" id="mobil-beyaz" class="rd" name="tester" value="Beyaz" <?php echo $beyaz; ?>>
                    <label for="mobil-beyaz">Beyaz</label>
                </th>
            </tr>
            <tr>
                <th style="text-align: center">Form Düzeni</th>
                <th><input type="radio" id="Yatay" class="rd" name="duzen" value="Yatay" <?php echo $yatay; ?>>
                    <label for="Yatay">Yatay</label>  -  
                    <input type="radio" id="Dikey" class="rd" name="duzen" value="Dikey" <?php echo $dikey; ?>>
                    <label for="Dikey">Dikey</label>
                </th>
            </tr>
            </thead>
            <tr style="border-bottom: 1px solid #ddd;"><td colspan="2"><b>Renk & Boyut</b></td></tr>
                <tr>
                    <td style="text-align: center"><label for="arka_color">Arkaplan (Renk):</label></td>
                    <td><input name="arka_color" type="text" id="arka_color" class="color" value="<?php echo $veri["arka_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="yazi_color">Yazı (Boyut)(Renk):</label></td>
                    <td>
                        <input name="yazi_size" type="text" id="yazi_size" style="width:90px" value="<?php echo $veri["yazi_size"]; ?>">
                        <input name="yazi_color" type="text" id="yazi_color" style="width:90px" class="color" value="<?php echo $veri["yazi_color"]; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="button_color">Button (Renk):</label></td>

                    <td>
                        <input name="button_color" type="text" id="button_color" class="color" value="<?php echo $veri["button_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="buttonyazi_color">Button Yazı (Boyut)(Renk):</label></td>
                    <td><input name="button_size" type="text" id="button_size" style="width:90px" value="<?php echo $veri["button_size"]; ?>">
                        <input name="buttonyazi_color" type="text" id="buttonyazi_color" style="width:90px" class="color" value="<?php echo $veri["buttonyazi_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="border">Kenarlık (Renk):</label></td>
                    <td><input name="border" type="text" id="border" class="color" value="<?php echo $veri["border"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="input_arka_color">Input Arkaplan (Renk):</label></td>
                    <td><input name="input_arka_color" type="text" id="input_arka_color" class="color" value="<?php echo $veri["input_arka_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="input_font_color">Input Yazı (Renk):</label></td>
                    <td><input name="input_font_color" type="text" id="input_font_color" class="color" value="<?php echo $veri["input_font_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="select_arka_color">Select Arkaplan (Renk):</label></td>
                    <td><input name="select_arka_color" type="text" id="select_arka_color" class="color" value="<?php echo $veri["select_arka_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="select_font_color">Select Yazı (Renk):</label></td>
                    <td><input name="select_font_color" type="text" id="select_font_color" class="color" value="<?php echo $veri["select_font_color"]; ?>"></td>
                </tr>
                <tr>
                    <td style="text-align: center"><label for="multi_border">Select,Input,Button Border (Renk):</label></td>
                    <td>
                        <input name="multi_border_size" type="text" id="multi_border_size" style="width: 90px;" value="<?php echo $veri["multi_border_size"]; ?>">
                        <input name="multi_border" type="text" id="multi_border" class="color"  style="width: 90px;" value="<?php echo $veri["multi_border"]; ?>">

                    </td>
                </tr>
            <tr style="border-bottom: 1px solid #ddd;"><td colspan="2"><b>Genişlik & Yükseklik</b></td></tr>
                <tr>
                    <td>
                        <label for="form_width">
                            Form ( Genişlik ) :
                            <input name="form_width" type="text" id="form_width" value="<?php echo $veri["form_width"]; ?>"  style="width: 100px;" />
                        </label>
                    </td>
                    <td>
                        <label for="form_height">
                            Form ( Yükseklik ) :
                            <input name="form_height" type="text" id="form_height" value="<?php echo $veri["form_height"]; ?>" style="width: 100px;" />
                        </label>
                    </td>
                </tr>
            <tr>
                <td>
                    <label for="button_width">
                        Button (Genişlik):
                        <input name="button_width" type="text" id="button_width" value="<?php echo $veri["button_width"]; ?>" style="width: 100px;" />
                    </label>
                </td>
                <td>
                    <label for="button_height">
                        Button (Yükseklik):
                        <input name="button_height" type="text" id="button_height" value="<?php echo $veri["button_height"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="input_width">
                        Input ( Genişlik ) :
                        <input name="input_width" type="text" id="input_width" value="<?php echo $veri["input_width"]; ?>" style="width: 100px;" />
                    </label>
                </td>
                <td>
                    <label for="select_width">
                        Select ( Genişlik ) :
                        <input name="select_width" type="text" id="select_width" value="<?php echo $veri["select_width"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid #ddd;"><td colspan="2"><b>Margin & Padding</b></td></tr>
            <tr>
                <td>
                    <label for="form_margin">
                         Form ( Margin ) :
                        <input name="form_margin" type="text" id="form_margin" value="<?php echo $veri["form_margin"]; ?>" style="width: 110px;" />
                    </label>
                </td>
                <td>
                    <label for="form_padding">
                        Form ( Padding ) :
                        <input name="form_padding" type="text" id="form_padding" value="<?php echo $veri["form_padding"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="input_margin">
                         Input ( Margin ) :
                        <input name="input_margin" type="text" id="input_margin" value="<?php echo $veri["input_margin"]; ?>" style="width: 110px;" />
                    </label>
                </td>
                <td>
                    <label for="input_padding">
                        Input ( Padding ) :
                        <input name="input_padding" type="text" id="input_padding" value="<?php echo $veri["input_padding"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="select_margin">
                         Select ( Margin ) :
                        <input name="select_margin" type="text" id="select_margin" value="<?php echo $veri["select_margin"]; ?>" style="width: 110px;" />
                    </label>
                </td>
                <td>
                    <label for="select_padding">
                        Select ( Padding ) :
                        <input name="select_padding" type="text" id="select_padding" value="<?php echo $veri["select_padding"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="yazi_margin">
                         Yazilar ( Margin ) :
                        <input name="yazi_margin" type="text" id="yazi_margin" value="<?php echo $veri["yazi_margin"]; ?>" style="width: 110px;" />
                    </label>
                </td>
                <td>
                    <label for="yazi_padding">
                        Yazilar ( Padding ) :
                        <input name="yazi_padding" type="text" id="yazi_padding" value="<?php echo $veri["yazi_padding"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="button_padding">
                        Button ( Padding ):
                        <input name="button_padding" type="text" id="button_padding" value="<?php echo $veri["button_padding"]; ?>" style="width: 100px;" />
                    </label>
                </td>
                <td>
                    <label for="button_margin">
                        Button ( Margin ):
                        <input name="button_margin" type="text" id="button_margin" value="<?php echo $veri["button_margin"]; ?>" style="width: 100px;" />
                    </label>
                </td>
            </tr>
            <tr style="border-bottom: 1px solid #ddd;"><td colspan="2"><b>Radius</b></td></tr>
            <tr>
                <td colspan="2">
                    <label for="form_radius">
                        Form:
                        <input name="form_radius" type="text" id="form_radius" value="<?php echo $veri["form_radius"]; ?>" style="width: 60px;" />
                    </label>
                    <label for="input_radius">
                        Input:
                        <input name="input_radius" type="text" id="input_radius" value="<?php echo $veri["input_radius"]; ?>" style="width: 60px;" />
                    </label>
                    <label for="select_radius">
                        Select:
                        <input name="select_radius" type="text" id="select_radius" value="<?php echo $veri["select_radius"]; ?>" style="width: 60px;" />
                    </label>
                    <label for="button_radius">
                        Button:
                        <input name="button_radius" type="text" id="button_radius" value="<?php echo $veri["button_radius"]; ?>" style="width: 60px;" />
                    </label>
                </td>

            </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Kaydet"/></td>
                </tr>
            </tbody></table>
        </form>
        </div>
            <style>
                #SistemOtel,
                #SistemOtel input,
                #SistemOtel label,
                #SistemOtel select,
                #SistemOtel button,
                #SistemOtel textarea
                {
                    margin:0;
                    border:0;
                    padding:0;
                    display:inline-block;
                    vertical-align:middle;
                    white-space:normal;
                    background:none;
                    line-height:1;
                }
                #SistemOtel select{
                    text-align: center;
                }
            </style>
            <div id="tester-mobile" style="position: -webkit-sticky; /* Safari */position: sticky;top: 50px;margin-left:20%;width:430px;height:912px;float:left;background: url('<?php echo $IstUrl;?>admin/images/iphone6_front_black.png') no-repeat;border:none;box-sizing:border-box">
                <div style="position: relative;border:none;box-sizing: border-box;">
                <div id="mobil-theme" style="width:378px;max-width:378px;height:668px;position: absolute;left:25px;top:108px;border: none;box-sizing: border-box;">
                <?php
                echo SistemOtelBookEngineAdminForm(array());
                ?>
                </div>
                </div>
            </div>
        </div>

        <?php

    }
}

/**
 * Page : CSS & JS
 * Sitede Kullanılacak Ekstra CSS ve JavaScript
 * Komutları bu Alandan güncellenir.
 */
if(!function_exists("SistemOtelBookEngineStyle")){
    function SistemOtelBookEngineStyle(){
        echo '<h1>Sistem Otel - BookEngine Widget  |  <a href="admin.php?page=book-engine" class="button-hero"> Temalar</a></h1>';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            SistemOtelBookEngineUpdateOptions(false,$_POST);
            echo '<div class="success"
             style="background-color: #00a699;padding: 0.4em;width: 400px;color:#FFFFFF;font-size: 1.5em;border-radius: 0.4em">
            Ayarlar başarılı şekilde kaydedildi..
        </div>';
        }
        $veri=SistemOtelBookEngineGetOptions();
        ?>
        <form method="post">
            <div style="float: left;">
                <h3>CSS:</h3>
                <textarea name="css" style="width: 500px;" rows="10"><?php echo base64_decode($veri["css"]);?></textarea>
            </div>
            <div style="float: left;margin-left:2em;">
                <h3>Mobile CSS:</h3>
                <textarea name="mobile-css" style="width:500px;" rows="10"><?php echo base64_decode($veri["mobile-css"]);?></textarea>
            </div>
            <hr style="clear: both;margin:2em;"/>
            <div style="float: left;">
                <h3>JavaScript:</h3>
                <textarea name="javascript" style="width:500px;" rows="10"><?php echo base64_decode($veri["javascript"]);?></textarea>
            </div>
            <div  style="float: left;margin-left:2em;">
                <h3>Mobile JavaScript:</h3>
                <textarea name="mobile-javascript" style="width:500px;" rows="10"><?php echo base64_decode($veri["mobile-javascript"]);?></textarea>
            </div>
            <hr  style="clear: both;margin:2em;"/>
            <input type="submit" value="Kaydet" style="padding: 5px 0px;border-radius: 5px;background-color: #fff;border: 1px solid #ddd;font-size: 2em;width:300px"/>
        </form>

<?php
    }
}

/**
 * FrontEnd Oluşturucu
 * @ShortCode [SistemOtelWidget url="subdomain" checkin="Giriş" checkout="Çıkış" people="Kişi Sayısı" rooms="Oda Sayısı" button="Rezervasyon!" lang="tr_TR"]
 * @return string
 */
if(!function_exists("SistemOtelBookEngineFrontEndSet")) {
    function SistemOtelBookEngineFrontEndSet($data = [], $content = null)
    {
        $veri = SistemOtelBookEngineGetOptions();
        global $IstUrl;
        wp_enqueue_style( 'sistem-bookengine-style', $IstUrl.'public/css/styles.css' );
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('sistem-bookengine-datepicker', $IstUrl.'public/js/sistem-datepicker.js', array('jquery'));

        $output="";
        if(wp_is_mobile()){
            $theme=$veri["mobile-theme"];
            $mobil=true;
        }else{
            $theme=$veri["web-theme"];
            $mobil=false;
        }
        $output.=SistemOtelBookEnginePublicForm($data);
        $output.=SistemOtelBookEngineInlineStyle($veri);
        return $output;
    }
}

/**
 * Admin Panel Form Oluşturucu
 * @return string
 */
if(!function_exists("SistemOtelBookEngineAdminForm")) {
    function SistemOtelBookEngineAdminForm($data){
        if(!isset($data["url"]))        { $data["url"]="demo.istbooking.com"; }
        if(!isset($data["checkin"]))    { $data["checkin"]="Check-In"; }
        if(!isset($data["checkout"]))   { $data["checkout"]="Check-Out"; }
        if(!isset($data["people"]))     { $data["people"]="Adults"; }
        if(!isset($data["rooms"]))      { $data["rooms"]="Rooms"; }
        if(!isset($data["button"]))     { $data["button"]="Book Now!"; }
        $opts=SistemOtelBookEngineGetOptions();
        if(wp_is_mobile()){
            $veri=unserialize(base64_decode($opts["mobile-theme"]));
        }else{
            $veri=unserialize(base64_decode($opts["web-theme"]));
        }
        $output='<div id="SistemOtel">
        <form id="IstBooking" onsubmit="javascript:IstbookingSearch()" style="display: flex">
            <input type="hidden" id="sistem-url" value="https://'.$data["url"].'.istbooking.com/'.$data["lang"].'"/>
            <div class="bb_control">
                <label for="sistem-checkin">'.$data["checkin"].'</label>
                    <input type="text" id="sistem-checkin" />
            </div>
            <div class="bb_control">
                <label for="sistem-checkout">'.$data["checkout"].'</label>
                    <input type="text" id="sistem-checkout" />
            </div>
            <div class="bb_control">
                <div class="istbooking-group">
                <label for="sistem-people">'.$data["people"].'</label>
                    <select id="sistem-people">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
            <div class="bb_control">
                <label for="sistem-room">'.$data["rooms"].'</label>
                    <select id="sistem-room">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
            </div>
            <div class="bb_control">
                <input type="submit" id="IstBookingSubmit" value="'.$data["button"].'">
            </div>
        </form>
        </div>';
        return $output;
    }
}
/**
 * FrontEnd Form Oluşturucu
 * @return string
 */
if(!function_exists("SistemOtelBookEnginePublicForm")) {
    function SistemOtelBookEnginePublicForm($data){
        if(!isset($data["url"]))        { $data["url"]="demo.istbooking.com"; }
        if(!isset($data["checkin"]))    { $data["checkin"]="Check-In"; }
        if(!isset($data["checkout"]))   { $data["checkout"]="Check-Out"; }
        if(!isset($data["people"]))     { $data["people"]="Adults"; }
        if(!isset($data["rooms"]))      { $data["rooms"]="Rooms"; }
        if(!isset($data["button"]))     { $data["button"]="Book Now!"; }
        $opts=SistemOtelBookEngineGetOptions();
        if(wp_is_mobile()){
            $veri=unserialize(base64_decode($opts["mobile-theme"]));
        }else{
            $veri=unserialize(base64_decode($opts["web-theme"]));
        }
        $output='<div id="SistemOtel">
        <form id="IstBooking" onsubmit="javascript:IstbookingSearch()" style="display: flex">
            <input type="hidden" id="sistem-url" value="https://'.$data["url"].'.istbooking.com/'.$data["lang"].'"/>
            <div class="bb_control">
                <label for="sistem-checkin">'.$data["checkin"].'</label>
                    <input type="text" id="sistem-checkin" />
            </div>
            <div class="bb_control">
                <label for="sistem-checkout">'.$data["checkout"].'</label>
                    <input type="text" id="sistem-checkout" />
            </div>
            <div class="bb_control">
                <div class="istbooking-group">
                <label for="sistem-people">'.$data["people"].'</label>
                    <select id="sistem-people">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
            <div class="bb_control">
                <label for="sistem-room">'.$data["rooms"].'</label>
                    <select id="sistem-room">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
            </div>
            <div class="bb_control">
                <input type="submit" id="IstBookingSubmit" value="'.$data["button"].'">
            </div>
        </form>
        </div>';
        ?>
        <style>
            #tester,
            #tester-mobile,
            #SistemOtel,
            #SistemOtel input,
            #SistemOtel label,
            #SistemOtel select,
            #SistemOtel button,
            #SistemOtel textarea
            {
                box-sizing:border-box;
                margin:0;
                border:0;
                padding:0;
                display:inline-block;
                vertical-align:middle;
                white-space:normal;
                background:none;
                line-height:1;
            }
            #SistemOtel select {
                text-align: center;
            }
        </style>
        <script>
            document.addEventListener("DOMContentLoaded", function(){
                var $ = jQuery;
                <?php
                if($veri['duzen']=="Dikey"){
                ?>
                $("#IstBooking .bb_control").css({"float":"none","display":"block","position":"relative","width":"100%","height":"40px"});
                $("#IstBooking label").css({"position":"absolute","left":"0","display":"inline-block"});
                $("#IstBooking input[type=text]").css({"position":"absolute","right":"0"});
                $("#IstBooking select").css({"position":"absolute","right":"0","text-align":"center"});
                $("#IstBooking").css({"display":"flex","justify-content": "center","flex-direction":"column","align-items":"center"});
                <?php }else{ ?>
                $("#IstBooking input[type=text]").prev().append("<br />");
                $("#IstBooking select").prev().append("<br />")
                $("#IstBooking .bb_control").css({"float":"left","display":"block","position":"relative","width":""});
                $("#IstBooking label").css({"position":"relative","display":"block"});
                $("#IstBooking input[type=text]").css({"position":"relative"});
                $("#IstBooking select").css({"position":"relative","text-align":"center"});
                $("#IstBooking").css({"display":"flex","justify-content": "center","flex-direction":"row","align-items":"center"});
                <?php } ?>
                $("#SistemOtel").css({"box-sizing": "border-box"});
                var boyut = '<?php echo $veri['form_width']; ?>';
                $("#SistemOtel").css({"width": boyut});
                var boyut = '<?php echo $veri['form_height'];?>';
                $("#SistemOtel").css({"height": boyut});
                var boyut = '<?php echo $veri['button_width'];?>';
                $("#IstBookingSubmit").css({"width": boyut});
                var boyut = '<?php echo $veri['button_height'];?>';
                $("#IstBookingSubmit").css({"height": boyut});
                var boyut = '<?php echo $veri['select_width'];?>';
                $("#IstBooking select").css({"width": boyut});
                var boyut = '<?php echo $veri['input_width'];?>';
                $("#IstBooking input[type=text]").css({"width": boyut});
                var boyut = '<?php echo $veri['button_size'];?>';
                $("#IstBookingSubmit").css({"font-size": boyut});
                var boyut = '<?php echo $veri['yazi_size'];?>';
                $("#IstBooking").css({"font-size": boyut});
                var boyut = '<?php echo $veri['button_margin'];?>';
                $("#IstBookingSubmit").css({"margin": boyut});
                var boyut = '<?php echo $veri['button_padding'];?>';
                $("#IstBookingSubmit").css({"padding": boyut});
                var boyut = '<?php echo $veri['input_padding'];?>';
                $("#IstBooking input[type=text]").css({"padding": boyut});
                var boyut = '<?php echo $veri['input_margin'];?>';
                $("#IstBooking input[type=text]").css({"margin": boyut});
                var boyut = '<?php echo $veri['select_padding'];?>';
                $("#IstBooking select").css({"padding": boyut});
                var boyut = '<?php echo $veri['select_margin'];?>';
                $("#IstBooking select").css({"margin": boyut});
                var boyut = '<?php echo $veri['yazi_padding'];?>';
                $("#IstBooking label").css({"padding": boyut});
                var boyut = '<?php echo $veri['yazi_margin'];?>';
                $("#IstBooking label").css({"margin": boyut});
                var boyut = '<?php echo $veri['form_radius'];?>';
                $("#SistemOtel").css({
                    "-webkit-border-radius": boyut,
                    "-moz-border-radius": boyut,
                    "border-radius": boyut
                });
                var boyut = '<?php echo $veri['input_radius'];?>';
                $("#IstBooking input[type=text]").css({
                    "-webkit-border-radius": boyut,
                    "-moz-border-radius": boyut,
                    "border-radius": boyut
                });
                var boyut = '<?php echo $veri['select_radius'];?>';
                $("#IstBooking select").css({
                    "-webkit-border-radius": boyut,
                    "-moz-border-radius": boyut,
                    "border-radius": boyut
                });
                var boyut = '<?php echo $veri['button_radius'];?>';
                $("#IstBookingSubmit").css({
                    "-webkit-border-radius": boyut,
                    "-moz-border-radius": boyut,
                    "border-radius": boyut
                });
                var boyut = '<?php echo $veri['form_padding'];?>';
                $("#SistemOtel").css({"padding": boyut});
                var boyut = '<?php echo $veri['form_margin'];?>';
                $("#SistemOtel").css({"margin": boyut})
                var boyut='<?php echo $veri['arka_color'];?>';
                document.getElementById("SistemOtel").style.backgroundColor = boyut;
                var boyut='<?php echo $veri['yazi_color'];?>';
                $("#IstBooking ,.bb_control label").css({ "color":boyut});
                var boyut='<?php echo $veri['button_color'];?>';
                $("#IstBookingSubmit").css({ "background-color":boyut});
                var boyut='<?php echo $veri['buttonyazi_color'];?>';
                $("#IstBookingSubmit").css({ "color":boyut});
                var boyut='<?php echo $veri['border'];?>';
                $("#SistemOtel").css({ "border":"2px solid " + boyut});
                var boyut='<?php echo $veri['input_arka_color'];?>';
                $("#IstBooking input[type=text]").css({ "background-color":boyut});
                var boyut='<?php echo $veri['input_font_color'];?>';
                $("#IstBooking input[type=text]").css({ "color":boyut});
                var boyut='<?php echo $veri['select_arka_color'];?>';
                $("#IstBooking select").css({ "background-color":boyut});
                var boyut='<?php echo $veri['select_font_color'];?>';
                $("#IstBooking select").css({ "color":boyut});
                var boyut = '<?php echo $veri['multi_border_size'];?>';
                var color = '<?php echo $veri['multi_border'];?>';
                $("#IstBooking input[type=text], #IstBooking select , #IstBookingSubmit").css({ "border": boyut + " solid " + color});

            });
        </script>

        <?php
        return $output;
    }
}


/**
 * FrontEnd CSS ve JS Oluşturucu
 * @return string
 */
if(!function_exists("SistemOtelBookEngineInlineStyle")) {
    function SistemOtelBookEngineInlineStyle($veri){
        $output="";
        if(wp_is_mobile()){
            if($veri["mobile-css"]!=null){
                $output.="<!-- BookEngine Inline Mobile CSS Start -->\n";
                $output.="<style>\n";
                $output.=base64_decode($veri["css"]);
                $output.="\n</style>\n";
                $output.="\n<!-- BookEngine Inline Mobile CSS END -->\n\n";
            }
            if($veri["mobile-javascript"]!=null){
                $output.="<!-- BookEngine Inline Mobile JS Start -->\n";
                $output.="<script>\n";
                $output.=base64_decode($veri["javascript"]);
                $output.="\n</script>\n";
                $output.="\n<!-- BookEngine Inline Mobile JS END -->\n\n";
            }
        }else{
            if($veri["css"]!=null){
                $output.="<!-- BookEngine Inline CSS Start -->\n";
                $output.="<style>\n";
                $output.=base64_decode($veri["css"]);
                $output.="\n</style>\n";
                $output.="\n<!-- BookEngine Inline CSS END -->\n\n";
            }
            if($veri["javascript"]!=null){
                $output.="<!-- BookEngine Inline JS Start -->\n";
                $output.="<script>\n";
                $output.=base64_decode($veri["javascript"]);
                $output.="\n</script>\n";
                $output.="\n<!-- BookEngine Inline JS END -->\n\n";
            }
        }
        return $output;
    }
}