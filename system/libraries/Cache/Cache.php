<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class CI_Cache extends CI_Driver_Library {

	/**
	 * Valid cache drivers
	 *
	 * @var array
	 */
	protected $valid_drivers = array(
		'apc',
		'dummy',
		'file',
		'memcached',
		'redis',
		'wincache'
	);

	/**
	 * Path of cache files (if file-based cache)
	 *
	 * @var string
	 */
	protected $_cache_path = NULL;

	/**
	 * Reference to the driver
	 *
	 * @var mixed
	 */
	protected $_adapter = 'dummy';

	/**
	 * Fallback driver
	 *
	 * @var string
	 */
	protected $_backup_driver = 'dummy';

	/**
	 * Cache key prefix
	 *
	 * @var	string
	 */
	public $key_prefix = '';

	/**
	 * Constructor
	 *
	 * Initialize class properties based on the configuration array.
	 *
	 * @param	array	$config = array()
	 * @return	void
	 */
	public function __construct($config = array())
	{
		isset($config['adapter']) && $this->_adapter = $config['adapter'];
		isset($config['backup']) && $this->_backup_driver = $config['backup'];
		isset($config['key_prefix']) && $this->key_prefix = $config['key_prefix'];

		// If the specified adapter isn't available, check the backup.
		if ( ! $this->is_supported($this->_adapter))
		{
			if ( ! $this->is_supported($this->_backup_driver))
			{
				// Backup isn't supported either. Default to 'Dummy' driver.
				log_message('error', 'Cache adapter "'.$this->_adapter.'" and backup "'.$this->_backup_driver.'" are both unavailable. Cache is now using "Dummy" adapter.');
				$this->_adapter = 'dummy';
			}
			else
			{
				// Backup is supported. Set it to primary.
				log_message('debug', 'Cache adapter "'.$this->_adapter.'" is unavailable. Falling back to "'.$this->_backup_driver.'" backup adapter.');
				$this->_adapter = $this->_backup_driver;
			}
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Get
	 *
	 * Look for a value in the cache. If it exists, return the data
	 * if not, return FALSE
	 *
	 * @param	string	$id
	 * @return	mixed	value matching $id or FALSE on failure
	 */
	public function get($id)
	{
		return $this->{$this->_adapter}->get($this->key_prefix.$id);
	}

	// ------------------------------------------------------------------------

	/**
	 * Cache Save
	 *
	 * @param	string	$id	Cache ID
	 * @param	mixed	$data	Data to store
	 * @param	int	$ttl	Cache TTL (in seconds)
	 * @param	bool	$raw	Whether to store the raw value
	 * @return	bool	TRUE on success, FALSE on failure
	 */
	public function save($id, $data, $ttl = 60, $raw = FALSE)
	{
		return $this->{$this->_adapter}->save($this->key_prefix.$id, $data, $ttl, $raw);
	}

	// ------------------------------------------------------------------------

	/**
	 * Delete from Cache
	 *
	 * @param	string	$id	Cache ID
	 * @return	bool	TRUE on success, FALSE on failure
	 */
	public function delete($id)
	{
		return $this->{$this->_adapter}->delete($this->key_prefix.$id);
	}

	// ------------------------------------------------------------------------

	/**
	 * Increment a raw value
	 *
	 * @param	string	$id	Cache ID
	 * @param	int	$offset	Step/value to add
	 * @return	mixed	New value on success or FALSE on failure
	 */
	public function increment($id, $offset = 1)
	{
		return $this->{$this->_adapter}->increment($this->key_prefix.$id, $offset);
	}

	// ------------------------------------------------------------------------

	/**
	 * Decrement a raw value
	 *
	 * @param	string	$id	Cache ID
	 * @param	int	$offset	Step/value to reduce by
	 * @return	mixed	New value on success or FALSE on failure
	 */
	public function decrement($id, $offset = 1)
	{
		return $this->{$this->_adapter}->decrement($this->key_prefix.$id, $offset);
	}

	// ------------------------------------------------------------------------

	/**
	 * Clean the cache
	 *
	 * @return	bool	TRUE on success, FALSE on failure
	 */
	public function clean()
	{
		return $this->{$this->_adapter}->clean();
	}

	// ------------------------------------------------------------------------

	/**
	 * Cache Info
	 *
	 * @param	string	$type = 'user'	user/filehits
	 * @return	mixed	array containing cache info on success OR FALSE on failure
	 */
	public function cache_info($type = 'user')
	{
		return $this->{$this->_adapter}->cache_info($type);
	}

	// ------------------------------------------------------------------------

	/**
	 * Get Cache Metadata
	 *
	 * @param	string	$id	key to get cache metadata on
	 * @return	mixed	cache item metadata
	 */
	public function get_metadata($id)
	{
		return $this->{$this->_adapter}->get_metadata($this->key_prefix.$id);
	}

	// ------------------------------------------------------------------------

	/**
	 * Is the requested driver supported in this environment?
	 *
	 * @param	string	$driver	The driver to test
	 * @return	array
	 */
	public function is_supported($driver)
	{
		static $support;

		if ( ! isset($support, $support[$driver]))
		{
			$support[$driver] = $this->{$driver}->is_supported();
		}

		return $support[$driver];
	}
}
