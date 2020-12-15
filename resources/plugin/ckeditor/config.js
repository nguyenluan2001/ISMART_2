/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.authtication=true;
	config.allowedContent = true;
	config.filebrowserBrowseUrl = 'http://localhost:8080/UNITOP.VN/BACK-END/LARAVELPRO/MyShop/resources/plugin/ckfinder/ckfinder.html';
    config.filebrowserUploadUrl = 'http://localhost:8080/UNITOP.VN/BACK-END/LARAVELPRO/MyShop/resources/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserBrowseUrl= "http://localhost:8080/UNITOP.VN/BACK-END/LARAVELPRO/MyShop/resources/plugin/ckfinder/ckfinder.html";
	config.filebrowserUploadUrl= "http://localhost:8080/UNITOP.VN/BACK-END/LARAVELPRO/MyShop/resources/plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images";
};
