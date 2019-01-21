<?php
function theme_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );

}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

add_action ('woocommerce_before_main_content', 'mg_banner_header', 5);
	function mg_banner_header(){
		if (is_shop()) {
            echo do_shortcode('[metaslider id="1086"]');
        }
	}
add_action( 'woocommerce_before_main_content', 'infor', 10 );
function infor() {
  if(get_site_url()) {
    echo ('<section class="conteudo_info-screen">
    		<a href="https://www.mgeletronics.com.br/politica-de-entrega/" target="_blank" title="Envio rápido" class="link-info" alt="Envio Rápido">
    			<div class="infor-new">
    			<div style="font-size:3em; color:#f4d152; padding-bottom: 10px">
  				<i class="fa fa-truck"></i>
				</div>
    				<p>Entrega com</p>
    				<span>prazo e segurança</span>
    			</div>
    		</a>
			<a href="https://www.mgeletronics.com.br/condicoes-gerais/" target="_blank" title="Envio rápido" class="link-info" alt="Pagamento Facilitado">
    			<div class="infor-new">
    			<div style="font-size:3em; color:#f4d152; padding-bottom: 10px">
  				<i class="fa fa-money"></i>
				</div>
    				<p>Pagamento facilitado</p>
    				<span>em ate 12x sem juros</span>
    			</div>
    		</a>
			<a href="https://www.mgeletronics.com.br/condicoes-gerais/" target="_blank" title="Envio rápido" class="link-info" alt="Com desconto nos boletos">
    			<div class="infor-new">
    			<div style="font-size:3em; color:#f4d152; padding-bottom: 10px">
  				<i class="fa fa-credit-card"></i>
				</div>
    				<p>5% de desconto</p>
    				<span>Boleto Bancário</span>
    			</div>
    		</a>
    		<a href="https://www.mgeletronics.com.br/atendimento-ao-cliente/" target="_blank" title="Envio rápido" class="link-info" alt="Atedimento Especializado">
    			<div class="infor-new">
    			<div style="font-size:3em; color:#f4d152; padding-bottom: 10px">
  				<i class="fa fa-comments"></i>
				</div>
    				<p>Atendimento</p>
    				<span>Especializado</span>
    			</div>
    		</a>
    		<a href="https://www.mgeletronics.com.br/politica-de-privacidade/" target="_blank" title="Ambiente Seguro" class="link-info" alt="Ambiente Seguro">
    			<div class="infor-new">
    			<div style="font-size:3em; color:#f4d152; padding-bottom: 10px">
  				<i class="fa fa-lock"></i>
				</div>
    				<p>Ambiente Seguro</p>
    				<span>com Certificação</span>
    			</div>
    		</a>
    	</section>');
  }

}
function exemplo_dashicons_frontend() {
 wp_enqueue_style( 'dashicons' );
}

add_action( 'wp_enqueue_scripts', 'exemplo_dashicons_frontend' );
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 25;
  return $cols;
}
add_action( 'woocommerce_before_customer_login_form', 'custom_login_text_header' );
function custom_login_text_header() {
    if( ! is_user_logged_in() ){
        //Your link
        $link = home_url( 'minha-conta' );
        // The displayed (output)
        echo '<h1 class="block-header"> Entrar ou criar uma conta</div>';
    }
}
add_action( 'woocommerce_login_form_start', 'custom_login_text_form_login_start' );
function custom_login_text_form_login_start() {
    if( ! is_user_logged_in() ){
        //Your link
        $link = home_url( 'minha-conta' );
        // The displayed (output)
                echo '<p class="block-text">'. __("Caso possua registro conosco utilize os campos abaixo para acessar todas as suas informações").'</p>';
}

}
add_action( 'woocommerce_register_form_start', 'custom_login_text_form_register_start' );
function custom_login_text_form_register_start() {
    if( ! is_user_logged_in() ){
        //Your link
        $link = home_url( 'minha-conta' );
        // The displayed (output)
                echo '<p class="block-text">'. __("Ao criar uma conta em nossa loja, você poderá comprar, armazenar múltiplos endereços, visualizar e acompanhar os seus pedidos em sua conta e muito mais..<a/>", "woocommerce").'</p>';
}

}
add_action('woocommerce_before_checkout_billing_form', 'fields_before_order_details');
//function
function fields_before_order_details(){
  echo "<section>
      <div class='info-dados'>
          <h1 class='header-info'>Preencha os seu dados abaixo para concluir o seu pedido.</h1>
          <p>Temos todas as proteções ativas e os seus dados estarão seguros conosco.</p>
      </div>
  </section>";
}
add_action('woocommerce_before_checkout_shipping_form', 'add_text_before_billing');
//function
function add_text_before_billing(){
  echo "<section>
      <div class='info-dados'>
          <h1 class='header-info'>Utilize o formulário abaixo caso queira que o seu pedido seja entregue em um endereço diferente do seu.</h1>
      </div>
  </section>";
}
add_action('woocommerce_review_order_before_payment', 'information_payment');
//function
function information_payment(){
  echo "<section>
      <div class='info-dados'>
          <h1 class='block-header3'>Selecione o método de pagamento</h1>
      </div>
  </section>";
}
/**
 * Adds a custom message about how long will take to delivery.
 */
function my_wc_custom_cart_shipping_notice() {
	echo '<tr class="shipping-notice"><td colspan="2"><small class="block-text">';
	_e( '<strong>Atenção:</strong> O prazo de entrega começa a contar a partir da aprovação do pagamento.', 'my-text-domain' );
	echo '</small></td></tr>';
}
add_action( 'woocommerce_cart_totals_after_shipping', 'my_wc_custom_cart_shipping_notice' );
add_action( 'woocommerce_review_order_after_shipping', 'my_wc_custom_cart_shipping_notice' );
/**
 * Adds a custom message about how long will take to delivery in emails.
 *

 * @param  WC_Order $order         Order data.

 * @param  bool     $sent_to_admin True if is an admin email.

 */
function my_wc_custom_email_shipping_notice( $order, $sent_to_admin ) {
	if ( $sent_to_admin ) {
		return;
	}
	_e( '<strong>Atenção:</strong> O prazo de entrega começa a contar a partir da aprovação do pagamento.', 'my-text-domain' );
}
add_action( 'woocommerce_email_after_order_table', 'my_wc_custom_email_shipping_notice', 100, 2 );
add_action( 'woocommerce_before_checkout_form', 'wnd_checkout_message_bottom', 5);
function wnd_checkout_message_bottom( ) {
 echo '<p class="info-login"><span class="obs-verde">Atenção: </span>Se você já comprou conosco antes, informe seus dados nos campos abaixo. Se você é um cliente novo, siga para a seção de <strong>“Dados da Conta”</strong>.</p>';
}
function storefront_myaccount_customer_avatar() {
    $current_user = wp_get_current_user();

    echo '<div class="myaccount_avatar">' . get_avatar( $current_user->user_email, 72, '', $current_user->user_firstname ). "<div class='myaccount_user'><span>Olá senhor(a)<br/> $current_user->user_firstname $current_user->user_lastname</span><br/> <a href='http://www.mgeletronics.com.br/minha-conta/customer-logout/' alt='Sair da conta'>Sair</a> </div>" . '</div>';
}
add_action( 'woocommerce_before_account_navigation', 'storefront_myaccount_customer_avatar', 5);
/**

 * @snippet       Automatically Update Cart on Quantity Change - WooCommerce

 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055

 * @sourcecode    https://businessbloomer.com/?p=73470

 * @author        Rodolfo Melogli

 * @compatible    Woo 3.2.6

 */
add_action( 'wp_footer', 'bbloomer_cart_refresh_update_qty' ); 
function bbloomer_cart_refresh_update_qty() { 
    if (is_cart()) { 
        ?> 
        <script type="text/javascript"> 
            jQuery('div.woocommerce').on('click', 'input.qty', function(){ 
                jQuery("[name='update_cart']").trigger("click"); 

            }); 
        </script> 
        <?php 
    } 

}
add_filter( 'woocommerce_cart_item_subtotal', 'bbloomer_if_coupon_slash_item_subtotal', 99, 3 );
function bbloomer_if_coupon_slash_item_subtotal( $subtotal, $cart_item, $cart_item_key ){
global $woocommerce;
if ( $woocommerce->cart->has_discount( $coupon_code )) {
// Note: apply your own coupon discount multiplier here
// In this case, it's a 99% discount, hence I multiply by 0.1
$newsubtotal = wc_price( $cart_item['data']->get_price() * 0.05 * $cart_item['quantity'] ); 
$subtotal = sprintf( '<s>%s</s> <span class="green-descount">Desconto de: </span>%s', $subtotal, $newsubtotal ); 
} 
return $subtotal;
}
add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_show_sale_percentage_loop', 25 );
function bbloomer_show_sale_percentage_loop() {
global $product;
if ( $product->is_on_sale() ) {
if ( ! $product->is_type( 'variable' ) ) {
$max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
} else {
$max_percentage = 0;
foreach ( $product->get_children() as $child_id ) {

    $variation = wc_get_product( $child_id );

    $price = $variation->get_regular_price();

    $sale = $variation->get_sale_price();

    if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;

    if ( $percentage > $max_percentage ) {

        $max_percentage = $percentage;
    }
}
}
echo "<div class='sale-perc'>" . "<span>Desconto de -</span>" . round($max_percentage)  . "%</div>";
}
}
add_action( 'woocommerce_register_form_start', 'bbloomer_add_name_woo_account_registration' );
function bbloomer_add_name_woo_account_registration() {
    ?>
    <p class="form-row form-row-first">

    <label for="reg_billing_first_name"><?php _e( 'Nome', 'woocommerce' ); ?> <span class="required">*</span></label>

    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />

    </p>

    <p class="form-row form-row-last">

    <label for="reg_billing_last_name"><?php _e( 'Sobrenome', 'woocommerce' ); ?> <span class="required">*</span></label>

    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />

    </p>

 

    <div class="clear"></div>

 

    <?php

}

 

///////////////////////////////

// 2. VALIDATE FIELDS

 

add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3 );

 

function bbloomer_validate_name_fields( $errors, $username, $email ) {

    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {

        $errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );

    }

    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {

        $errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );

    }

    return $errors;

}

 

///////////////////////////////

// 3. SAVE FIELDS

 

add_action( 'woocommerce_created_customer', 'bbloomer_save_name_fields' );

 

function bbloomer_save_name_fields( $customer_id ) {

    if ( isset( $_POST['billing_first_name'] ) ) {

        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );

        update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']) );

    }

    if ( isset( $_POST['billing_last_name'] ) ) {

        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );

        update_user_meta( $customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']) );

    }

 

}



/**

 * @snippet       Edit "Have a Coupon" message @ WooCommerce Checkout

 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055

 * @sourcecode    https://businessbloomer.com/?p=21348

 * @author        Rodolfo Melogli

 * @testedwith    WooCommerce 2.6.8, WordPress 4.7

 */

 

add_filter( 'woocommerce_checkout_coupon_message', 'bbloomer_have_coupon_message');

 

function bbloomer_have_coupon_message() {

return 'Você tem um cupom de desconto? <a href="#" class="showcoupon">Clique aqui para inserir.</a>';

}



/*

 * Step 1. Add Link to My Account menu

 */

add_filter ( 'woocommerce_account_menu_items', 'misha_log_history_link', 40 );

function misha_log_history_link( $menu_links ){

 

    $menu_links = array_slice( $menu_links, 0, 5, true ) 

    + array( 'atendimento' => 'Atendimento' )

    + array_slice( $menu_links, 5, NULL, true );

 

    return $menu_links;

 

}

/*

 * Step 2. Register Permalink Endpoint

 */

add_action( 'init', 'misha_add_endpoint' );

function misha_add_endpoint() {

    // WP_Rewrite is my Achilles' heel, so please do not ask me for detailed explanation

    add_rewrite_endpoint( 'atendimento', EP_PAGES );
}

/*

 * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint

 */

add_action( 'woocommerce_account_atendimento_endpoint', 'misha_my_account_endpoint_content' );

function misha_my_account_endpoint_content() {
    // of course you can print dynamic content here, one of the most useful functions here is get_current_user_id()

    echo "<div>
        
    <h1 class='block-dashboard-header'>Atendimento ao cliente</h1>
    <hr>
    <p class='block-text'>Responderemos no maior tempo possível, também temos o nosso Whatsapp e Número Fixo.

    <strong>Whatsapp:</strong> 92 99178-5314</br>
    <strong>Contato:</strong> 92 3307-3559</br>
    </p>
    </div>";
    echo do_shortcode('[contact-form-7 id="17" title="Formulário de contato 1"]');
}

/*

 * Step 4

 */

// Go to Settings > Permalinks and just push "Save Changes" button.

// 

//

add_action('wpo_wcpdf_after_document_label', 'add_text_test');

function add_text_test(){

    echo "<p class='block-fatura'>ENDEREÇO DE ENTREGA</p>";

}



/**

 * @snippet       Merge Two "My Account" Tabs @ WooCommerce Account

 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055

 * @source        https://businessbloomer.com/?p=73601

 * @author        Rodolfo Melogli

 * @compatible    Woo 3.3.3

 */

 

// -------------------------------

// 1. First, hide the tab that needs to be merged/moved (edit-address in this case)

 

add_filter( 'woocommerce_account_menu_items', 'bbloomer_remove_address_my_account', 999 );

  

function bbloomer_remove_address_my_account( $items ) {

unset($items['edit-address']);

unset($items['downloads']);

return $items;

}

 

// -------------------------------

// 2. Second, print the ex tab content into an existing tab (edit-account in this case)

 

add_action( 'woocommerce_account_edit-account_endpoint', 'woocommerce_account_edit_address' );





add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );

function woo_new_product_tab( $tabs ) {

    

    // Adds the new tab

    

    $tabs['test_tab'] = array(

        'title'     => __( 'Dúvidas Sobre o Produto', 'woocommerce' ),

        'priority'  => 50,

        'callback'  => 'woo_new_product_tab_content'

    );



    return $tabs;



}

function woo_new_product_tab_content() {



    // The new tab content



   echo "<p class='block-form'>Caso esteja com alguma dúvida sobre o produto acima, não hesite em nos questionar, estaremos online e lhe responderemos de imediato.</p>";

   echo do_shortcode('[contact-form-7 id="17" title="Formulário de contato 1"]');

    

}

function alterando_footer_admin () {

 

  echo 'MG Eletronics - <strong>Todos os direitos reservados 2018</strong>';

 

}

 

add_filter('admin_footer_text', 'alterando_footer_admin');



add_filter( 'woocommerce_cart_shipping_method_full_label', 'change_shipping_label', 10, 2 );



function change_shipping_label( $full_label, $method ){



    $full_label = str_replace( "International Shipping (Free)", "Call Us For Rates", $full_label );



    return $full_label;

}

add_filter( 'woocommerce_cart_subtotal', 'bbloomer_slash_cart_subtotal_if_discount', 99, 3 );

 

function bbloomer_slash_cart_subtotal_if_discount( $cart_subtotal, $compound, $obj ){

global $woocommerce;

if ( $woocommerce->cart->get_cart_discount_total() <> 0 ) {

$new_cart_subtotal = wc_price( WC()->cart->subtotal - $woocommerce->cart->get_cart_discount_tax_total() - $woocommerce->cart->get_cart_discount_total() );

$cart_subtotal = sprintf( '<del>%s</del> <b>%s</b>', $cart_subtotal , $new_cart_subtotal );

}

return $cart_subtotal;

}



/**

 * REQUIRES WC 3.0+

 */

/**

 * Adds a new column to the "My Orders" table in the account.

 *

 * @param string[] $columns the columns in the orders table

 * @return string[] updated columns

 */

function sv_wc_add_my_account_orders_column( $columns ) {

  $new_columns = array();

  foreach ( $columns as $key => $name ) {

    $new_columns[ $key ] = $name;

    // add ship-to after order status column

    if ( 'order-status' === $key ) {

      $new_columns['order-ship-to'] = __( 'Enviar para', 'textdomain' );

    }

  }

  return $new_columns;

}

add_filter( 'woocommerce_my_account_my_orders_columns', 'sv_wc_add_my_account_orders_column' );

/**

 * Adds data to the custom "ship to" column in "My Account > Orders".

 *

 * @param \WC_Order $order the order object for the row

 */

function sv_wc_my_orders_ship_to_column( $order ) {

  $formatted_name = $order->get_billing_first_name() . '&nbsp;' .$order->get_billing_last_name();

  echo ! empty( $formatted_name ) ? $formatted_name : '&ndash;';

}

add_action( 'woocommerce_my_account_my_orders_column_order-ship-to', 'sv_wc_my_orders_ship_to_column' );


add_action('woocommerce_single_product_summary', 'mg_show_condiction_on_product_page', 10);

function mg_show_condiction_on_product_page(){
    if(has_term( 'vitrine', 'product_cat' )){
        echo "<div class='obs-vitrine'><i class='fa fa-exclamation-triangle fa-2x'></i> <span class='obs-product-header'>PRODUTO DE VITRINE</span><p class='obs-product-text'>Por favor, Leia a descrição</p></div>";
    }
}

add_filter( 'woocommerce_checkout_fields', 'bbloomer_change_autofocus_checkout_field' );
 
function bbloomer_change_autofocus_checkout_field( $fields ) {
$fields['billing']['billing_first_name']['autofocus'] = false;
$fields['billing']['billing_email']['autofocus'] = true;
return $fields;
}
/**
* @snippet  Hide "Shipping Calculator" Fields @ WooCommerce Cart
* @how-to   Watch tutorial @ https://businessbloomer.com/?p=19055
* @sourcecode   https://businessbloomer.com/?p=74646
* @author   Rodolfo Melogli
* @testedwith   WooCommerce 3.4.2
*/
 
// 1 Disable State
add_filter( 'woocommerce_shipping_calculator_enable_state', '__return_false' );
 
// 2 Disable City
add_filter( 'woocommerce_shipping_calculator_enable_city', '__return_false' );

add_filter( 'woocommerce_shipping_calculator_enable_country', '__return_false' );

function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
            height: 65px;
    width: 320px;
    background-size: 208px 96px;
    background-repeat: no-repeat;
    padding-bottom: 25px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'MG Eletronics - Tudo em um só lugar!';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function my_custom_wc_theme_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'my_custom_wc_theme_support' );

// display an 'Out of Stock' label on archive pages
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_stock', 20 );
function woocommerce_template_loop_stock() {
    global $product;
    if ( $product->managing_stock() && ! $product->is_in_stock() )
        echo '<p class="stock out-of-stock">Fora de estoque</p>';
}

?>

