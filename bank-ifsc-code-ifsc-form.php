<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
<style>

.bankifsc:before, .bankifsc:after{
    content:"";
    display:table;
}
 
.bankifsc:after{
    clear:both;
}
 
.bankifsc{
    zoom:1;
}    

 /* Form wrapper styling */
.bank-ifsc-code-search-wrapper {
width: 220px;
margin: 45px auto 50px auto;
box-shadow: 0 1px 1px rgba(0, 0, 0, .4) inset, 0 1px 0 rgba(255, 255, 255, .2);
}
 
.bank-ifsc-code-search-wrapper input {
width: 138px;
padding: 12px 5px;
float: left;
font: bold 15px 'lucida sans', 'trebuchet MS', 'Tahoma';
border: 0;
background: #EEE;
border-radius: 3px 0 0 3px;
}
 
.bank-ifsc-code-search-wrapper input:focus {
    outline: 0;
    background: #fff;
    box-shadow: 0 0 2px rgba(0,0,0,.8) inset;
}
 
.bank-ifsc-code-search-wrapper input::-webkit-input-placeholder {
   color: #999;
   font-weight: normal;
   font-style: italic;
}
 
.bank-ifsc-code-search-wrapper input:-moz-placeholder {
    color: #999;
    font-weight: normal;
    font-style: italic;
}
 
.bank-ifsc-code-search-wrapper input:-ms-input-placeholder {
    color: #999;
    font-weight: normal;
    font-style: italic;
}    
 
/* Form submit button */
.bank-ifsc-code-search-wrapper button {
overflow: visible;
position: relative;
float: right;
border: 0;
padding: 0;
cursor: pointer;
height: 40px;
width: 72px;
font: bold 15px/40px 'lucida sans', 'trebuchet MS', 'Tahoma';
color: white;
text-transform: uppercase;
background: #D83C3C;
border-radius: 0 3px 3px 0;
text-shadow: 0 -1px 0 rgba(0, 0, 0, .3);
}
   
.bank-ifsc-code-search-wrapper button:hover{     
    background: #e54040;
}   
   
.bank-ifsc-code-search-wrapper button:active,
.bank-ifsc-code-search-wrapper button:focus{   
    background: #c42f2f;
    outline: 0;   
}
 
.bank-ifsc-code-search-wrapper button:before { /* left arrow */
    content: '';
    position: absolute;
    border-width: 8px 8px 8px 0;
    border-style: solid solid solid none;
    border-color: transparent #d83c3c transparent;
    top: 12px;
    left: -6px;
}
 
.bank-ifsc-code-search-wrapper button:hover:before{
    border-right-color: #e54040;
}
 
.bank-ifsc-code-search-wrapper button:focus:before,
.bank-ifsc-code-search-wrapper button:active:before{
        border-right-color: #c42f2f;
}      
 
.bank-ifsc-code-search-wrapper button::-moz-focus-inner { /* remove extra button spacing for Mozilla Firefox */
    border: 0;
    padding: 0;
}    

#bankIfscCode {
    width: 100%;
    height: 100%;
    border: 3px solid green;
    margin: auto;
    padding: 10px;
}
</style>
<div id="bankIfscCode">
<h4>Find Bank Branch Details/Address/MICR Code By <a href="https://www.pakainfo.com/ifsc/" target="_blank">IFSC Code</a></h4>
<p>Type IFSC code to Know Branch Details of any Bank in India Find IFSC, MICR Codes, Address, All Bank Branches in India, for NEFT, RTGS, ECS Transactions.</p>
<form method="post" class="bank-ifsc-code-search-wrapper bankifsc">
	<?php wp_nonce_field( 'find-bank-ifsc-code', 'ifsc_code_generate_nonce' );?>

	<input type="textbox" name="ifsc_textbox" class="ifsc_textbox" value="<?php echo $ifsc_textbox?>" placeholder="Eneter IFSC Code" required=""/>
	<button type="submit" name="submit">Search</button>
</form>
<br/>
<?php 


$ifsc_textbox='';
if(isset($_POST['ifsc_textbox'])){
	if(!wp_verify_nonce('ifsc_code_generate_nonce','find-bank-ifsc-code')){
		$ifsc_textbox= sanitize_text_field($_POST['ifsc_textbox']);
		$results = bankIfscCodegetRemoteDataContentHtml($ifsc_textbox);

	    if( ! empty($results)){
	        echo stripslashes($results->getifscinfo);
	    } else {
	    	echo "No record found";
	    }
		
	}else{
		echo "No record found";
	}
}
?>