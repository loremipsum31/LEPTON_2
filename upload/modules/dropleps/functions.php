<?php

/**
 * This file is part of an ADDON for use with LEPTON Core.
 * This ADDON is released under the GNU GPL.
 * Additional license terms can be seen in the info.php of this module.
 *
 * @module          dropleps
 * @author          LEPTON Project
 * @copyright       2010-2014 LEPTON Project
 * @link            http://www.LEPTON-cms.org
 * @license         http://www.gnu.org/licenses/gpl.html
 * @license_terms   please see info.php of this module
 *
 */

// include class.secure.php to protect this file and the whole CMS!
if (defined('LEPTON_PATH'))
{
    include(LEPTON_PATH . '/framework/class.secure.php');
}
else
{
    $oneback = "../";
    $root    = $oneback;
    $level   = 1;
    while (($level < 10) && (!file_exists($root . '/framework/class.secure.php')))
    {
        $root .= $oneback;
        $level += 1;
    }
    if (file_exists($root . '/framework/class.secure.php'))
    {
        include($root . '/framework/class.secure.php');
    }
    else
    {
        trigger_error(sprintf("[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
    }
}
// end include class.secure.php

/**
 * this function may be called by modules to handle a droplep upload
 **/
function dropleps_upload( $input ) {

    global $database, $admin;
    
    // Set temp vars
    $temp_dir   = LEPTON_PATH.'/temp/';
    $temp_file  = $temp_dir . $_FILES[$input]['name'];
    $temp_unzip = LEPTON_PATH.'/temp/unzip/';
    $errors     = array();

    // Try to upload the file to the temp dir
    if( ! move_uploaded_file( $_FILES[$input]['tmp_name'], $temp_file ) )
    {
   	    return array( 'error', $admin->lang->translate( 'Upload failed' ) );
    }

    $result = dropleps_import( $temp_file, $temp_unzip );

    // Delete the temp zip file
    if( file_exists( $temp_file) )
    {
        unlink( $temp_file );
    }
    rm_full_dir($temp_unzip);

    // show errors
    if ( isset( $result['errors'] ) && is_array( $result['errors'] ) && count( $result['errors'] ) > 0 ) {
        return array( 'error', $result['errors'], NULL );
    }
    
    // return success
    return array( 'success', $result['count'] );
    
}   // end function dropleps_upload()


/**
 * this function may be called by modules to install a droplep 
 **/
function droplep_install( $temp_file, $temp_unzip ) {

    global $admin, $database;

    // Include the PclZip class file
    if (!function_exists("PclZipUtilPathReduction")) {
    require_once(LEPTON_PATH.'/modules/lib_lepton/pclzip/pclzip.lib.php');
    }
    $errors  = array();
    $count   = 0;
    $archive = new PclZip($temp_file);
    $list    = $archive->extract(PCLZIP_OPT_PATH, $temp_unzip);

    // now, open all *.php files and search for the header;
    // an exported droplet starts with "//:"
    if ( $dh = opendir($temp_unzip) ) {
        while ( false !== ( $file = readdir($dh) ) )
        {
            if ( $file != "." && $file != ".." )
            {
                if ( preg_match( '/^(.*)\.php$/i', $file, $name_match ) ) {
                    // Name of the Droplet = Filename
                    $name  = $name_match[1];
                    // Slurp file contents
                    $lines = file( $temp_unzip.'/'.$file );
                    // First line: Description
                    if ( preg_match( '#^//\:(.*)$#', $lines[0], $match ) ) {
                        $description = $match[1];
                    }
                    // Second line: Usage instructions
                    if ( preg_match( '#^//\:(.*)$#', $lines[1], $match ) ) {
                        $usage       = addslashes( $match[1] );
                    }
                    // Remaining: Droplet code
                    $code = implode( '', array_slice( $lines, 2 ) );
                    // replace 'evil' chars in code
                    $tags = array('<?php', '?>' , '<?');
                    $code = addslashes(str_replace($tags, '', $code));
                    // Already in the DB?
                    $stmt  = 'INSERT';
                    $id    = NULL;
                    $found = $database->get_one("SELECT * FROM ".TABLE_PREFIX."mod_dropleps WHERE name='$name'");
                    if ( $found && $found > 0 ) {
                        $stmt = 'REPLACE';
                        $id   = $found;
                    }
                    // execute
                    $result = $database->query("$stmt INTO ".TABLE_PREFIX."mod_dropleps VALUES('$id','$name','$code','$description','".time()."','".$admin->get_user_id()."',1,0,0,0,'$usage')");
                    if( ! $database->is_error() ) {
                        $count++;
                        $imports[$name] = 1;
                    }
                    else {
                        $errors[$name] = $database->get_error();
                    }
                    // try to remove the temp file
                    unlink( $temp_unzip.'/'.$file);
                }
            }
        }
        closedir($dh);
    }
    
    return array( 'count' => $count, 'errors' => $errors, 'imported'=> $imports );
    
}   // end function droplep_install()

/**
 * get a list of all dropleps and show them
 **/
function list_dropleps( $info = NULL )
{
    global $admin, $parser, $database, $settings, $MOD_DROPLEP;

    // check for global read perms
    $groups = $admin->get_groups_id();

	$backups = 1;
    $rows = array();

    $fields = 't1.id, name, code, description, active, comments, view_groups, edit_groups';
    $query  = $database->query( "SELECT $fields FROM " . TABLE_PREFIX . "mod_dropleps AS t1 LEFT OUTER JOIN " . TABLE_PREFIX . "mod_dropleps_permissions AS t2 ON t1.id=t2.id ORDER BY name ASC" );

    if ( $query->numRows() )
    {
        while ( $droplet = $query->fetchRow( MYSQL_ASSOC ) )
        {
            // the current user needs global edit permissions, or specific edit permissions to see this droplep
            if ( !is_allowed( 'modify_dropleps', $groups ) )
            {
                // get edit groups for this droplep
                if ( $droplet[ 'edit_groups' ] )
                {
                    if ( $admin->get_user_id() != 1 && !is_in_array( $droplet[ 'edit_groups' ], $groups ) )
                    {
                        continue;
                    }
                    else
                    {
                        $droplet[ 'user_can_modify_this' ] = true;
                    }
                }
            }
            $comments = str_replace( array(
                "\r\n",
                "\n",
                "\r"
            ), '<br />', $droplet[ 'comments' ] );
            if ( !strpos( $comments, "[[" ) ) //
            {
                $comments = '<span class="usage">' . $MOD_DROPLEP[ 'Use' ] . ": [[" . $droplet[ 'name' ] . "]]</span><br />" . $comments;
            }
            $comments = str_replace( array(
                "[[",
                "]]"
            ), array(
                '<b>[[',
                ']]</b>'
            ), $comments );
            $droplet[ 'valid_code' ] = check_syntax( $droplet[ 'code' ] );
            $droplet[ 'comments' ] = $comments;
            // droplet included in search?
	        $droplet['is_in_search'] = true;
            // is there a data file for this droplet?
            if ( file_exists( dirname( __FILE__ ) . '/data/' . $droplet[ 'name' ] . '.txt' ) || file_exists( dirname( __FILE__ ) . '/data/' . strtolower( $droplet[ 'name' ] ) . '.txt' ) || file_exists( dirname( __FILE__ ) . '/data/' . strtoupper( $droplet[ 'name' ] ) . '.txt' ) )
            {
                $droplet[ 'datafile' ] = true;
            }
            array_push( $rows, $droplet );
        }
    }

    echo $parser->render( 
    	'index.lte', 
    	array(
        'rows'       => $rows,
        'num_rows'	=> count($rows),
        'info'       => $info,
        'backups'    => ( ( count( $backups ) && is_allowed( 'Manage backups', $groups ) ) ? 1 : NULL ),
        'can_export' => ( is_allowed( 'Export dropleps', $groups ) ? 1 : NULL ),
        'can_import' => ( is_allowed( 'Import dropleps', $groups ) ? 1 : NULL ),
        'can_delete' => ( is_allowed( 'Delete dropleps', $groups ) ? 1 : NULL ),
        'can_modify' => ( is_allowed( 'Modify dropleps', $groups ) ? 1 : NULL ),
        'can_perms'  => ( is_allowed( 'Manage perms', $groups ) ? 1 : NULL ),
        'can_add'    => ( is_allowed( 'Add dropleps', $groups ) ? 1 : NULL )
    ) );

} // end function list_dropleps()

/**
 *
 **/
function manage_backups()
{
    global $admin, $parser, $database, $settings, $MOD_DROPLEP;

    $groups = $admin->get_groups_id();
    if ( !is_allowed( 'Manage backups', $groups ) )
    {
        $admin->print_error( $MOD_DROPLEP[ "You don't have the permission to do this" ] );
    }

    $rows = array();
    $info = NULL;

    // recover
    if ( isset( $_REQUEST[ 'recover' ] ) && file_exists( dirname( __FILE__ ) . '/export/' . $_REQUEST[ 'recover' ] ) )
    {
        if ( !function_exists( 'dropleps_upload' ) )
        {
            include_once( dirname( __FILE__ ) . '/include.php' );
        }
        $temp_unzip = LEPTON_PATH . '/temp/unzip/';
        $result     = dropleps_import( dirname( __FILE__ ) . '/export/' . $_REQUEST[ 'recover' ], $temp_unzip );
        $info       = sprintf($MOD_DROPLEP[ 'Successfully imported [{{count}}] Droplep(s)'], array(
             'count' => $result[ 'count' ]
        ) );
    }

    // delete single backup
    if ( isset( $_REQUEST[ 'delbackup' ] ) && file_exists( dirname( __FILE__ ) . '/export/' . $_REQUEST[ 'delbackup' ] ) )
    {
        unlink( dirname( __FILE__ ) . '/export/' . $_REQUEST[ 'delbackup' ] );
		$info = str_replace("{{file}}", $_REQUEST[ 'delbackup' ], $MOD_DROPLEP[ 'Backup file deleted: {{file}}']);
    }

    // delete a list of backups
    // get all marked dropleps
    $marked = isset( $_POST[ 'markeddroplet' ] ) ? $_POST[ 'markeddroplet' ] : array();

    if ( count( $marked ) )
    {
        $deleted = array();
        foreach ( $marked as $file )
        {
            $file = dirname( __FILE__ ) . '/export/' . $file ;
            if ( file_exists( $file ) )
            {
                unlink( $file );
				$deleted[] = str_replace("{{file}}", basename( $file ) , $MOD_DROPLEP[ 'Backup file deleted: {{file}}'] );
            }
        }
        if ( count( $deleted ) )
        {
            $info = implode( '<br />', $deleted );
        }
    }

    $backups = file_list( dirname( __FILE__ ) . '/export' , array('index.php') );

    if ( count( $backups ) > 0 )
    {
        // sort by name
        sort( $backups );
        foreach ( $backups as $file )
        {
            // stat
            $stat   = stat( $file );
            
            // get zip contents
			require_once(LEPTON_PATH.'/modules/lib_lepton/pclzip/pclzip.lib.php');
            $oZip = new PclZip( $file );            
            $count  = $oZip->listContent();
            $rows[] = array(
                'name' => basename( $file ),
                'size' => $stat[ 'size' ],
                'date' => strftime( '%c', $stat[ 'ctime' ] ),
                'files' => count( $count ),
                'listfiles' => implode( ", ", array_map( create_function( '$cnt', 'return $cnt["filename"];' ), $count ) ),
                'download' =>  LEPTON_URL . '/modules/dropleps/export/' . basename( $file )
            );
        }
    }

    echo $parser->render(
    	'backups.lte',
    	array(
        	'rows' => $rows,
        	'info' => $info,
        	'backups' => ( count( $backups ) ? 1 : NULL ),
        	'num_rows' => count( $rows )
    	)
    );

} // end function manage_backups()

/**
 *
 **/
function manage_perms()
{
    global $admin, $parser, $database, $settings, $MOD_DROPLEP;
    $info   = NULL;
    $groups = array();
    $rows   = array();

    $this_user_groups = $admin->get_groups_id();
    if ( !is_allowed( 'Manage perms', $this_user_groups ) )
    {
        $admin->print_error( $MOD_DROPLEP[ "You don't have the permission to do this" ] );
    }

    // get available groups
    $query = $database->query( 'SELECT group_id, name FROM ' . TABLE_PREFIX . 'groups ORDER BY name' );
    if ( $query->numRows() )
    {
        while ( $row = $query->fetchRow( MYSQL_ASSOC ) )
        {
            $groups[ $row[ 'group_id' ] ] = $row[ 'name' ];
        }
    }

    if ( isset( $_REQUEST[ 'save' ] ) || isset( $_REQUEST[ 'save_and_back' ] ) )
    {
        foreach ( $settings as $key => $value )
        {
            if ( isset( $_REQUEST[ $key ] ) )
            {
                $database->query( 'UPDATE ' . TABLE_PREFIX . "mod_dropleps_settings SET value='" . implode( '|', $_REQUEST[ $key ] ) . "' WHERE attribute='" . $key . "';" );
            }
        }
        // reload settings
        $settings = get_settings();
        $info     = $MOD_DROPLEP[ 'Permissions saved' ];
        if ( isset( $_REQUEST[ 'save_and_back' ] ) )
        {
            return list_dropleps( $info );
        }
    }

    foreach ( $settings as $key => $value )
    {
        $line = array();
        foreach ( $groups as $id => $name )
        {
            $line[] = '<input type="checkbox" name="' . $key . '[]" id="' . $key . '_' . $id . '" value="' . $id . '"' . ( is_in_array( $value, $id ) ? ' checked="checked"' : NULL ) . ' />' . '<label for="' . $key . '_' . $id . '">' . $name . '</label>' . "\n";
        }
        $rows[] = array(
            'groups' => implode( '', $line ),
            'name' => $MOD_DROPLEP[ $key ]
        );
    }

    // sort rows by permission name (=text)
	sort($rows);
	
    echo $parser->render(
    	'permissions.lte',
    	array(
        'rows' => $rows,
        'info' => $info,
        'num_rows' => count($rows)
    ) );

} // end function manage_perms()

/**
 *
 **/
function export_dropleps()
{
    global $admin, $parser, $database, $MOD_DROPLEP;

    $groups = $admin->get_groups_id();
    if ( !is_allowed( 'export_dropleps', $groups ) )
    {
        $admin->print_error( $MOD_DROPLEP[ "You don't have the permission to do this" ] );
    }

    $info = array();

    // get all marked dropleps
    $marked = isset( $_POST[ 'markeddroplet' ] ) ? $_POST[ 'markeddroplet' ] : array();

    if ( isset( $marked ) && !is_array( $marked ) )
    {
        $marked = array(
             $marked
        );
    }

    if ( !count( $marked ) )
    {
        return $MOD_DROPLEP[ 'Please mark some Dropleps to export' ];
    }

    $temp_dir = LEPTON_PATH . '/temp/dropleps/';

    // make the temporary working directory
    @mkdir( $temp_dir );

    foreach ( $marked as $id )
    {
        $result = $database->query( "SELECT * FROM " . TABLE_PREFIX . "mod_dropleps WHERE id='$id'" );
        if ( $result->numRows() > 0 )
        {
            $droplet = $result->fetchRow( MYSQL_ASSOC );
            $name    = $droplet[ "name" ];
            $info[]  = 'Droplep: ' . $name . '.php<br />';
            $sFile   = $temp_dir . $name . '.php';
            $fh      = fopen( $sFile, 'w' );
            fwrite( $fh, '//:' . $droplet[ 'description' ] . "\n" );
            fwrite( $fh, '//:' . str_replace( "\n", " ", $droplet[ 'comments' ] ) . "\n" );
            fwrite( $fh, $droplet[ 'code' ] );
            fclose( $fh );
            $file = NULL;
            
            //	look for a data file
            $file_names = array(
            	dirname( __FILE__ ) . '/data/' . $droplet[ 'name' ] . '.txt',
            	dirname( __FILE__ ) . '/data/' . strtolower( $droplet[ 'name' ] ) . '.txt',
            	dirname( __FILE__ ) . '/data/' . strtoupper( $droplet[ 'name' ] ) . '.txt'
            );
            foreach($file_names as $temp_file_name)
            {	
				if ( file_exists( $temp_file_name ) )
				{
					$file = $temp_file_name;
					break;
				}
			}

            if ( $file )
            {
                if ( !file_exists( $temp_dir . '/data' ) )
                {
                    @mkdir( $temp_dir . '/data' );
                }
                copy( $file, $temp_dir . '/data/' . basename( $file ) );
            }
        }
    }

    $filename = 'dropleps';

    // if there's only a single droplet to export, name the zip-file after this droplet
    if ( count( $marked ) === 1 )
    {
        $filename = 'droplep_' . $name;
    }

    // add current date to filename
    $filename .= '_' . date( 'Y-m-d' );

    // while there's an existing file, add a number to the filename
    if ( file_exists( LEPTON_PATH . '/modules/dropleps/export/' . $filename . '.zip' ) )
    {
        $n = 1;
        while ( file_exists( LEPTON_PATH . '/modules/dropleps/export/' . $filename . '_' . $n . '.zip' ) )
        {
            $n++;
        }
        $filename .= '_' . $n;
    }

    $temp_file = LEPTON_PATH . '/temp/' . $filename . '.zip';

    // create zip
    require_once(LEPTON_PATH.'/modules/lib_lepton/pclzip/pclzip.lib.php');
    $archive   = new PclZip($temp_file);
    $file_list = $archive->create($temp_dir, PCLZIP_OPT_REMOVE_ALL_PATH);
    if ($file_list == 0){
    	  echo "Packaging error: ", $archive->errorInfo(true), "<br />";
    	  die("Error : ".$archive->errorInfo(true));
    }
    else {
        // create the export folder if it doesn't exist
        if ( ! file_exists( LEPTON_PATH.'/modules/dropleps/export' ) ) {
            mkdir(LEPTON_PATH.'/modules/dropleps/export');
        }
        if ( ! copy( $temp_file, LEPTON_PATH.'/modules/dropleps/export/'.$filename.'.zip' ) ) {
            echo '<div class="drfail">Unable to move the exported ZIP-File!</div>';
            $download = LEPTON_URL.'/temp/'.$filename.'.zip';
        }
        else {
            unlink( $temp_file );
            $download = LEPTON_URL.'/modules/dropleps/export/'.$filename.'.zip';
        }
    	  echo '<div class="drok">Backup created - <a href="'.$download.'">Download</a></div>';
    }
    rm_full_dir($temp_dir);

    return $MOD_DROPLEP[ 'Backup created' ] . '<br /><br />' . implode( "\n", $info ) . '<br /><br /><a href="' . $download . '">Download</a>';

} // end function export_dropleps()

/**
 *
 **/
function import_dropleps()
{
    global $admin, $parser, $database, $MOD_DROPLEP;

    $groups = $admin->get_groups_id();
    if ( !is_allowed( 'Import dropleps', $groups ) )
    {
        $admin->print_error( $MOD_DROPLEP[ "You don't have the permission to do this" ] );
    }

    $problem = NULL;

    if ( count( $_FILES ) )
    {
        if ( !function_exists( 'dropleps_upload' ) )
        {
            include_once( dirname( __FILE__ ) . '/include.php' );
        }
        list( $result, $data ) = dropleps_upload( 'file' );
        $info = NULL;
        if ( is_array( $data ) )
        {
            $isIndexed = array_values( $data ) === $data;
            if ( $isIndexed )
            {
                $info .= implode( '<br />', $data );
            }
            else
            {
                foreach ( $data as $key => $value )
                {
                    $info .= $key . ' -> ' . $value . "<br />";
                }
            }
        }
        if ( $result == 'error' )
        {
            $problem = $MOD_DROPLEP[ 'An error occurred when trying to import the Droplep(s)' ] . '<br /><br />' . $info;
        }
        else
        {
            list_dropleps( sprintf($MOD_DROPLEP[ 'Successfully imported [{{count}}] Droplep(s)'], array(
                 'count' => $data
            ) ) );
            return;
        }
    }

    echo $parser->render(
    	'import.lte',
    	array(
        	 'problem' => $problem
    	)
    );

} // end function import_dropleps()

/**
 *
 **/
function delete_dropleps()
{
    global $admin, $parser, $database, $MOD_DROPLEP;

    $groups = $admin->get_groups_id();
    if ( !is_allowed( 'delete_dropleps', $groups ) )
    {
        $admin->print_error( $MOD_DROPLEP[ "You don't have the permission to do this" ] );
    }

    $errors = array();

    // get all marked dropleps
    $marked = isset( $_POST[ 'markeddroplet' ] ) ? $_POST[ 'markeddroplet' ] : array();

    if ( isset( $marked ) && !is_array( $marked ) )
    {
        $marked = array(
             $marked
        );
    }

    if ( !count( $marked ) )
    {
        list_dropleps( $MOD_DROPLEP[ 'Please mark some Dropleps to delete' ] );
        return; // should never be reached
    }

    foreach ( $marked as $id )
    {
        // get the name; needed to delete data file
        $query = $database->query( "SELECT name FROM " . TABLE_PREFIX . "mod_dropleps WHERE id = '$id'" );
        $data  = $query->fetchRow( MYSQL_ASSOC );
        $database->query( "DELETE FROM " . TABLE_PREFIX . "mod_dropleps WHERE id = '$id'" );
        if ( $database->is_error() )
        {
            $errors[] = sprintf($MOD_DROPLEP[ 'Unable to delete droplep: {{id}}'], array(
                 'id' => $id
            ) );
        }
        
        // look for a data file
        $file_names = array(
        	dirname( __FILE__ ) . '/data/' . $data[ 'name' ] . '.txt',
        	dirname( __FILE__ ) . '/data/' . strtolower( $data[ 'name' ] ) . '.txt',
        	dirname( __FILE__ ) . '/data/' . strtoupper( $data[ 'name' ] ) . '.txt'
        );
        foreach($file_names as $temp_file_name) {
			if ( file_exists( $temp_file_name) )
        	{
            	unlink( $temp_file_name );
        	}
        }
    }

    list_dropleps( implode( "<br />", $errors ) );
    return;

} // end function delete_dropleps()

/**
 * copy a droplep
 **/
function copy_droplep( $id )
{
    global $database, $admin, $MOD_DROPLEP;

    $groups = $admin->get_groups_id();
    if ( !is_allowed( 'modify_dropleps', $groups ) )
    {
        $admin->print_error( $MOD_DROPLEP[ "You don't have the permission to do this" ] );
    }

    $query    = $database->query( "SELECT * FROM " . TABLE_PREFIX . "mod_dropleps WHERE id = '$id'" );
    $data     = $query->fetchRow( MYSQL_ASSOC );
    $tags     = array(
        '<?php',
        '?>',
        '<?'
    );
    $code     = addslashes( str_replace( $tags, '', $data[ 'code' ] ) );
    $new_name = $data[ 'name' ] . "_copy";
    $i        = 1;

    // look for doubles
    $found = $database->query( 'SELECT * FROM ' . TABLE_PREFIX . "mod_dropleps WHERE name='$new_name'" );
    while ( $found->numRows() > 0 )
    {
        $new_name = $data[ 'name' ] . "_copy" . $i;
        $found    = $database->query( 'SELECT * FROM ' . TABLE_PREFIX . "mod_dropleps WHERE name='$new_name'" );
        $i++;
    }

    // generate query
    $query = "INSERT INTO " . TABLE_PREFIX . "mod_dropleps VALUES "
    //         ID      NAME         CODE              DESCRIPTION                            MOD_WHEN                     MOD_BY
		   . "(''," . "'$new_name', " . "'$code', " . "'" . $data[ 'description' ] . "', " . "'" . time() . "', " . "'" . $admin->get_user_id() . "', " . "1,1,1,0,'" . $data[ 'comments' ] . "' )";

    // add new droplet
    $result = $database->query( $query );
    if ( !$database->is_error() )
    {
        $new_id = $database->db_handle->lastInsertId();
        return edit_droplep( $new_id );
    }
    else
    {
        echo "ERROR: ", $database->get_error();
    }
}

/**
 * edit a droplep
 **/
function edit_droplep( $id )
{
    global $admin, $parser, $database, $MOD_DROPLEP, $TEXT;

    $groups = $admin->get_groups_id();

    if ( $id == 'new' && !is_allowed( 'add_dropleps', $groups ) )
    {
        $admin->print_error( $MOD_DROPLEP[ "You don't have the permission to do this" ] );
    }
    else
    {
        if ( !is_allowed( 'modify_dropleps', $groups ) )
        {
            $admin->print_error( $MOD_DROPLEP[ "You don't have the permission to do this" ] );
        }
    }

    $problem  = NULL;
    $info     = NULL;
    $problems = array();

    if ( isset( $_POST[ 'cancel' ] ) )
    {
        return list_dropleps();
    }

    if ( $id != 'new' )
    {
        $query        = $database->query( "SELECT * FROM " . TABLE_PREFIX . "mod_dropleps WHERE id = '$id'" );
        $data         = $query->fetchRow( MYSQL_ASSOC );
    }
    else
    {
        $data = array(
            'name' => '',
            'active' => 1,
            'description' => '',
            'code' => '',
            'comments' => ''
        );
    }

    if ( isset( $_POST[ 'save' ] ) || isset( $_POST[ 'save_and_back' ] ) )
    {
        // check the code before saving
        if ( !check_syntax( stripslashes( $_POST[ 'code' ] ) ) )
        {
            $problem      = $MOD_DROPLEP['Please check the syntax!'];
            $data         = $_POST;
            $data['code'] = htmlspecialchars($data['code']);
        }
        else
        {
            // syntax okay, check fields and save
            if ( $admin->get_post( 'name' ) == '' )
            {
                $problems[] = $MOD_DROPLEP['Please enter a name!'];
            }
            if ( $admin->get_post( 'code' ) == '' )
            {
                $problems[] = $MOD_DROPLEP['You have entered no code!'];
            }

            if ( !count( $problems ) )
            {
                $continue      = true;
                $title         = $admin->add_slashes( $admin->get_post( 'name' ) );
                $active        = $admin->get_post( 'active' );
                $show_wysiwyg  = $admin->get_post( 'show_wysiwyg' );
                $description   = $admin->add_slashes( $admin->get_post( 'description' ) );
                $tags          = array(
                    '<?php',
                    '?>',
                    '<?'
                );
                $content       = str_replace( $tags, '', $admin->get_post( 'code' ) );
                $comments      = $admin->add_slashes( $admin->get_post( 'comments' ) );
                $modified_when = time();
                $modified_by   = $admin->get_user_id();
                if ( $id == 'new' )
                {
                    // check for doubles
                    $query = $database->query( "SELECT * FROM " . TABLE_PREFIX . "mod_dropleps WHERE name = '$title'" );
                    if ( $query->numRows() > 0 )
                    {
                        $problem  = $MOD_DROPLEP['There is already a droplep with the same name!'];
                        $continue = false;
                        $data     = $_POST;
                        $data['code'] = stripslashes( $_POST[ 'code' ] );
                    }
                    else
                    {
						$code  = $admin->add_slashes( $content );
						// generate query
						$query = "INSERT INTO " . TABLE_PREFIX . "mod_dropleps VALUES "
							   . "(''," . "'$title', " . "'$code', " . "'$description', " . "'$modified_when', " . "'$modified_by', " . "'$active',1,1, '$show_wysiwyg', '$comments' )";
					    $result = $database->query( $query );
					    if ( $database->is_error() )
					    {
					        echo "ERROR: ", $database->get_error();
					    }
                        
                    }
                }
                else
                {
                    // Update row
                    $database->query( "UPDATE " . TABLE_PREFIX . "mod_dropleps SET name = '$title', active = '$active', show_wysiwyg = '$show_wysiwyg', description = '$description', code = '"
                                    . $admin->add_slashes( $content )
                                    . "', comments = '$comments', modified_when = '$modified_when', modified_by = '$modified_by' WHERE id = '$id'"
                    );
                    // reload Droplep data
                    $query = $database->query( "SELECT * FROM " . TABLE_PREFIX . "mod_dropleps WHERE id = '$id'" );
                    $data  = $query->fetchRow( MYSQL_ASSOC );
                }
                if ( $continue )
                {
                    // Check if there is a db error
                    if ( $database->is_error() )
                    {
                        $problem = $database->get_error();
                    }
                    else
                    {
                        if ( $id == 'new' || isset( $_POST[ 'save_and_back' ] ) )
                        {
                            list_dropleps( $MOD_DROPLEP['The Droplep was saved'] );
                            return; // should never be reached
                        }
                        else
                        {
                            $info = $MOD_DROPLEP['The Droplep was saved']; # $MOD_DROPLEP[ 'The Droplep was saved' );
                        }
                    }
                }
            }
            else
            {
                $problem = implode( "<br />", $problems );
            }
        }
    }

    echo $parser->render(
    	'edit.lte',
    	array(
    	'LANG'	=> $MOD_DROPLEP,
        'problem' => $problem,
        'info' => $info,
        'data' => $data,
        'id'   => $id,
        'name' => $data[ 'name' ],
		    'register_area' => registerEditArea( 'code'),
        'TEXT' => $TEXT
    ) );
} // end function edit_droplep()

/**
 *
 **/
function edit_droplep_perms( $id )
{
    global $admin, $parser, $database, $MOD_DROPLEP;

    // look if user can set permissions
    $this_user_groups = $admin->get_groups_id();
    if ( !is_allowed( 'Manage perms', $this_user_groups ) )
    {
        $admin->print_error( $MOD_DROPLEP["You don't have the permission to do this"] );
    }

    $info = NULL;

    // get available groups
    $query = $database->query( 'SELECT group_id, name FROM ' . TABLE_PREFIX . 'groups ORDER BY name' );
    if ( $query->numRows() )
    {
        while ( $row = $query->fetchRow( MYSQL_ASSOC ) )
        {
            $groups[ $row[ 'group_id' ] ] = $row[ 'name' ];
        }
    }

    // save perms
    if ( isset( $_REQUEST[ 'save' ] ) || isset( $_REQUEST[ 'save_and_back' ] ) )
    {
        $edit = (
					  isset($_REQUEST['edit_groups'])
					? ( is_array($_REQUEST['edit_groups']) ? implode('|',$_REQUEST['edit_groups']) : $_REQUEST['edit_groups'] )
					: NULL
				);
        $view = (
					  isset($_REQUEST['view_groups'])
					? ( is_array($_REQUEST['view_groups']) ? implode('|',$_REQUEST['view_groups']) : $_REQUEST['view_groups'] )
					: NULL
				);
        $database->query( 'REPLACE INTO ' . TABLE_PREFIX . "mod_dropleps_permissions VALUES( '$id', '$edit', '$view' );" );
        $info = $MOD_DROPLEP['The Droplep was saved'];
        if ( isset( $_REQUEST[ 'save_and_back' ] ) )
        {
            return list_dropleps( $info );
        }
    }

    // get droplep data
    $query = $database->query( "SELECT * FROM " . TABLE_PREFIX . "mod_dropleps AS t1 LEFT OUTER JOIN ".TABLE_PREFIX."mod_dropleps_permissions AS t2 ON t1.id=t2.id WHERE t1.id = '$id'" );
    $data  = $query->fetchRow( MYSQL_ASSOC );

    foreach ( array(
        'Edit groups',
        'View groups'
    ) as $key )
    {
        $allowed_groups = ( isset( $data[ $key ] ) ? explode( '|', $data[ $key ] ) : array ());
        $line           = array();
        foreach ( $groups as $gid => $name )
        {
            $line[] = '<input type="checkbox" name="' . $key . '[]" id="' . $key . '_' . $gid . '" value="' . $gid . '"' . ( ( is_in_array( $allowed_groups, $gid ) || !count( $allowed_groups ) ) ? ' checked="checked"' : NULL ) . '>' . '<label for="' . $key . '_' . $gid . '">' . $name . '</label>' . "\n";
        }
        $rows[] = array(
            'groups' => implode( '', $line ),
            'name' => $MOD_DROPLEP[ $key ]
        );
    }

    echo $parser->render(
    'droplep_permissions.lte',
    array(
        'rows' => $rows,
        'info' => $info,
        'id'   => $id,
        'num_rows' => count($rows)
    ) );

} // end function edit_droplep_perms()

/**
 * edit a droplep's datafile
 **/
function edit_datafile( $id )
{
    global $admin, $parser, $database,$MOD_DROPLEP;
    $info = $problem = NULL;

    $groups = $admin->get_groups_id();
    if ( !is_allowed( 'modify_dropleps', $groups ) )
    {
        $admin->print_error( $MOD_DROPLEP["You don't have the permission to do this"] );
    }

    if ( isset( $_POST[ 'cancel' ] ) )
    {
        return list_dropleps();
    }

    $query = $database->query( "SELECT name FROM " . TABLE_PREFIX . "mod_dropleps WHERE id = '$id'" );
    $data  = $query->fetchRow( MYSQL_ASSOC );

	$files = array(
		dirname( __FILE__ ) . '/data/' . $data[ 'name' ] . '.txt',
		dirname( __FILE__ ) . '/data/' . strtolower( $data[ 'name' ] ) . '.txt',
		dirname( __FILE__ ) . '/data/' . strtoupper( $data[ 'name' ] ) . '.txt'
	);
	foreach($files as &$temp_filename)
	{
	
    	// find the file
    	if ( file_exists( $temp_filename ) )
    	{
    		$file = $temp_filename;
    		break;
    	}
    }

    // slurp file
    $contents = implode( '', file( $file ) );

    if ( isset( $_POST[ 'save' ] ) || isset( $_POST[ 'save_and_back' ] ) )
    {
        $new_contents = htmlentities( $_POST[ 'contents' ] );
        // create backup copy
        copy( $file, $file . '.bak' );
        $fh = fopen( $file, 'w' );
        if ( is_resource( $fh ) )
        {
            fwrite( $fh, $new_contents );
            fclose( $fh );
            $info = $MOD_DROPLEP['The datafile has been saved'];
            if ( isset( $_POST[ 'save_and_back' ] ) )
            {
                return list_dropleps( $info );
            }
        }
        else
        {
            $problem = sprintf($MOD_DROPLEP[ 'Unable to write to file [{{file}}]'], array(
                 'file' => str_ireplace( LEPTON_PATH, 'LEPTON_PATH', $file )
            ) );
        }
    }

    $parser->output( 'edit_datafile.lte', array(
        'info' => $info,
        'problem' => $problem,
        'name' => $data[ 'name' ],
        'id' => $id,
        'contents' => htmlspecialchars( $contents )
    ) );
} // end function edit_droplep()


/**
 *	Aldus: switch between active/inactive
 **/
function toggle_active( $id )
{
    global $admin, $parser, $database;

    $groups = $admin->get_groups_id();
    if ( !is_allowed( 'modify_dropleps', $groups ) )
    {
        $admin->print_error( $MOD_DROPLEP[ "You don't have the permission to do this" ] );
    }

    $query = $database->query( "SELECT `active` FROM " . TABLE_PREFIX . "mod_dropleps WHERE id = '$id'" );
    $data  = $query->fetchRow( MYSQL_ASSOC );

    $new = ( $data[ 'active' ] == 1 ) ? 0 : 1;

    $database->query( 'UPDATE ' . TABLE_PREFIX . "mod_dropleps SET active='$new' WHERE id = '$id'" );

} // end function toggle_active()

/**
 * checks if any item of $allowed is in $current
 **/
function is_in_array( $allowed, $current )
{
    if ( !is_array( $allowed ) )
    {
        if ( substr_count( $allowed, '|' ) )
        {
            $allowed = explode( '|', $allowed );
        }
        else
        {
            $allowed = array(
                 $allowed
            );
        }
    }
    if ( !is_array( $current ) )
    {
        if ( substr_count( $current, '|' ) )
        {
            $current = explode( '|', $current );
        }
        else
        {
            $current = array(
                 $current
            );
        }
    }
    foreach ( $allowed as $gid )
    {
        if ( in_array( $gid, $current ) )
        {
            return true;
        }
    }
    return false;
} // end function is_in_array()

/**
 *
 **/
function is_allowed( $perm, $gid )
{
    global $admin, $settings;
    // admin is always allowed to do all
    if ( $admin->get_user_id() == 1 )
    {
        return true;
    }
    if ( !array_key_exists( $perm, $settings ) )
    {
        return false;
    }
    else
    {
        $value = $settings[ $perm ];
        if ( !is_array( $value ) )
        {
            $value = array(
                 $value
            );
        }
        return is_in_array( $value, $gid );
    }
    return false;
} // end function is_allowed()

/**
 * check the syntax of given code
 **/
function check_syntax( $code )
{
    return @eval( 'return true;' . $code );
}

/**
 * get the module settings from the DB; returns array
 **/
function get_settings()
{
    global $admin, $database;
    $settings = array();
    $query    = $database->query( 'SELECT * FROM ' . TABLE_PREFIX . 'mod_dropleps_settings' );
    if ( $query->numRows() )
    {
        while ( $row = $query->fetchRow( MYSQL_ASSOC ) )
        {
            if ( substr_count( $row[ 'value' ], '|' ) )
            {
                $row[ 'value' ] = explode( '|', $row[ 'value' ] );
            }
            $settings[ $row[ 'attribute' ] ] = $row[ 'value' ];
        }
    }
    return $settings;
} // end function get_settings()


?>