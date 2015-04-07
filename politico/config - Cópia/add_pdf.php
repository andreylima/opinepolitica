<?php



add_action("admin_init", "pdf_init");
add_action('save_post', 'save_pdf_link');

function pdf_init(){
        add_meta_box("my-pdf", "PDF Document", "pdf_link", "projeto", "normal", "low");
        }
        
function pdf_link(){
        global $post;
        $custom  = get_post_custom($post->ID);
        $link    = $custom["link"][0];
        $count   = 0;
        echo '<div class="link_header">';
        $query_pdf_args = array(
                'post_type' => 'attachment',
                'post_mime_type' =>'application/pdf',
                'post_status' => 'inherit',
                'posts_per_page' => -1,
                );
        $query_pdf = new WP_Query( $query_pdf_args );
        $pdf = array();
        echo '<select name="link">';
        echo '<option class="pdf_select">SELECT pdf FILE</option>';
        foreach ( $query_pdf->posts as $file) {
           if($link == $pdf[]= $file->guid){
              echo '<option value="'.$pdf[]= $file->guid.'" selected="true">'.$pdf[]= $file->guid.'</option>';
                 }else{
              echo '<option value="'.$pdf[]= $file->guid.'">'.$pdf[]= $file->guid.'</option>';
                 }
                $count++;
        }
        echo '</select><br /></div>';
        echo '<p>Selecting a pdf file from the above list to attach to this post.</p>';
        echo '<div class="pdf_count"><span>Files:</span> <b>'.$count.'</b></div>';
}
function save_pdf_link(){
        global $post;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){ return $post->ID; }
        update_post_meta($post->ID, "link", $_POST["link"]);
}
add_action( 'admin_head', 'pdf_css' );
function pdf_css() {
        echo '<style type="text/css">
        .pdf_select{
                font-weight:bold;
                background:#e5e5e5;
                }
        .pdf_count{
                font-size:9px;
                color:#0066ff;
                text-transform:uppercase;
                background:#f3f3f3;
                border-top:solid 1px #e5e5e5;
                padding:6px 6px 6px 12px;
                margin:0px -6px -8px -6px;
                -moz-border-radius:0px 0px 6px 6px;
                -webkit-border-radius:0px 0px 6px 6px;
                border-radius:0px 0px 6px 6px;
                }
        .pdf_count span{color:#666;}
                </style>';
}
function pdf_file_url(){
        global $wp_query;
        $custom = get_post_custom($wp_query->post->ID);
        echo $custom['link'][0];
}







?>