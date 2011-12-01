<?php // $Id: class.dbconnection.php 12923 2011-03-03 14:23:57Z abourguignon $
if ( count( get_included_files() ) == 1 ) die( '---' );

    // vim: expandtab sw=4 ts=4 sts=4:

    /**
     * CLAROLINE
     *
     * @version 1.8 $Revision: 12923 $
     *
 * @copyright   (c) 2001-2011, Universite catholique de Louvain (UCL)
     *
     * @license http://www.gnu.org/copyleft/gpl.html (GPL) GENERAL PUBLIC LICENSE
     * This program is under the terms of the GENERAL PUBLIC LICENSE (GPL)
     * as published by the FREE SOFTWARE FOUNDATION. The GPL is available
     * through the world-wide-web at http://www.gnu.org/copyleft/gpl.html
     *
     * @author Frederic Minne <zefredz@gmail.com>
     *
     * @package Wiki
     */

    class CLWIKI_Database_Connection
    {
        var $error = '';
        var $errno = 0;
        var $connected = false;

        function setError( $errmsg = '', $errno = 0 )
        {
            trigger_error( "Call to undefined abstract method in "
                . __CLASS__ . "->" . __FUNCTION__
                , E_USER_ERROR
                );
        }

        function getError()
        {
            if ( $this->error != '' )
            {
                $errno = $this->errno;
                $error = $this->error;
                $this->error = '';
                $this->errno = 0;
                return $errno.' - '.$error;
            }
            else
            {
                return false;
            }
        }

        function hasError()
        {
            return ( $this->error != '' );
        }

        function connect()
        {
            trigger_error( "Call to undefined abstract method in "
                . __CLASS__ . "->" . __FUNCTION__
                , E_USER_ERROR
                );
        }

        function isConnected()
        {
            return $this->connected;
        }

        function close()
        {
            trigger_error( "Call to undefined abstract method in "
                . __CLASS__ . "->" . __FUNCTION__
                , E_USER_ERROR
                );
        }

        function executeQuery( $sql )
        {
            trigger_error( "Call to undefined abstract method in "
                . __CLASS__ . "->" . __FUNCTION__
                , E_USER_ERROR
                );
        }

        function getAllObjectsFromQuery( $sql )
        {
            trigger_error( "Call to undefined abstract method in "
                . __CLASS__ . "->" . __FUNCTION__
                , E_USER_ERROR
                );
        }

        function getObjectFromQuery( $sql )
        {
            trigger_error( "Call to undefined abstract method in "
                . __CLASS__ . "->" . __FUNCTION__
                , E_USER_ERROR
                );
        }

        function getAllRowsFromQuery( $sql )
        {
            trigger_error( "Call to undefined abstract method in "
                . __CLASS__ . "->" . __FUNCTION__
                , E_USER_ERROR
                );
        }

        function getRowFromQuery( $sql )
        {
            trigger_error( "Call to undefined abstract method in "
                . __CLASS__ . "->" . __FUNCTION__
                , E_USER_ERROR
                );
        }

        function queryReturnsResult( $sql )
        {
            trigger_error( "Call to undefined abstract method in "
                . __CLASS__ . "->" . __FUNCTION__
                , E_USER_ERROR
                );
        }

        function getLastInsertID()
        {
            trigger_error( "Call to undefined abstract method in "
                . __CLASS__ . "->" . __FUNCTION__
                , E_USER_ERROR
                );
        }
    }

    class MyDatabaseConnection extends CLWIKI_Database_Connection
    {
        var $db_link;
        var $host;
        var $username;
        var $passwd;
        var $dbname;

        function MyDatabaseConnection( $host, $username, $passwd, $dbname )
        {
            $this->db_link = null;
            $this->host = $host;
            $this->username = $username;
            $this->passwd = $passwd;
            $this->dbname = $dbname;
        }

        function setError( $errmsg = '', $errno = 0 )
        {
            if ( $errmsg != '' )
            {
                $this->error = $errmsg;
                $this->errno = $errno;
            }
            else
            {
                $this->error = ( @mysql_error() !== false ) ? @mysql_error() : 'Unknown error';
                $this->errno = ( @mysql_errno() !== false ) ? @mysql_errno() : 0;
            }

            $this->connected = false;
        }

        function connect()
        {
            $this->db_link = @mysql_connect( $this->host, $this->username, $this->passwd );

            if( ! $this->db_link )
            {
                $this->setError();

                return false;
            }

            if( @mysql_select_db( $this->dbname, $this->db_link ) )
            {
                $this->connected = true;
                return true;
            }
            else
            {
                $this->setError();

                return false;
            }
        }

        function close()
        {
            if( $this->db_link != false )
            {
                @mysql_close( $this->db_link );
            }
            else
            {
                $this->setError( "No connection found" );
            }
            $this->connected = false;
        }

        function executeQuery( $sql )
        {
            mysql_query( $sql, $this->db_link );

            if( @mysql_errno( $this->db_link ) != 0 )
            {
                $this->setError();

                return 0;
            }

            return @mysql_affected_rows( $this->db_link );
        }

        function getAllObjectsFromQuery( $sql )
        {
            $result = mysql_query( $sql, $this->db_link );

            if ( @mysql_num_rows( $result ) > 0 )
            {
                $ret= array();

                while( ( $item = @mysql_fetch_object( $result ) ) != false )
                {
                    $ret[] = $item;
                }
            }
            else
            {
                $this->setError();

                @mysql_free_result( $result );

                return null;
            }

            @mysql_free_result( $result );

            return $ret;
        }

        function getObjectFromQuery( $sql )
        {
            $result = mysql_query( $sql, $this->db_link );

            if ( ( $item = @mysql_fetch_object( $result ) ) != false )
            {
                @mysql_free_result( $result );

                return $item;
            }
            else
            {
                $this->setError();

                @mysql_free_result( $result );
                return null;
            }
        }

        function getAllRowsFromQuery( $sql )
        {
            $result = mysql_query( $sql, $this->db_link );

            if ( @mysql_num_rows( $result ) > 0 )
            {
                $ret= array();

                while ( ( $item = @mysql_fetch_array( $result ) ) != false )
                {
                    $ret[] = $item;
                }
            }
            else
            {
                $this->setError();

                @mysql_free_result( $result );

                return null;
            }

            @mysql_free_result( $result );

            return $ret;
        }

        function getRowFromQuery( $sql )
        {
            $result = mysql_query( $sql, $this->db_link );

            if ( ( $item = @mysql_fetch_array( $result ) ) != false )
            {
                @mysql_free_result( $result );

                return $item;
            }
            else
            {
                $this->setError();

                @mysql_free_result( $result );

                return null;
            }
        }

        function queryReturnsResult( $sql )
        {
            $result = mysql_query( $sql, $this->db_link );

            if ( @mysql_errno( $this->db_link ) == 0 )
            {

                if ( @mysql_num_rows( $result ) > 0 )
                {
                    @mysql_free_result( $result );

                    return true;
                }
                else
                {
                    @mysql_free_result( $result );

                    return false;
                }
            }
            else
            {
                $this->setError();

                return false;
            }
        }

        function getLastInsertID()
        {
            if ( $this->hasError() )
            {
                return 0;
            }
            else
            {
                return mysql_insert_id( $this->db_link );
            }
        }
    }
?>