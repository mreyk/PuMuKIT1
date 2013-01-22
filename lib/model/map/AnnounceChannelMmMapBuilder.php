<?php


/**
 * This class adds structure of 'announce_channel_mm' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class AnnounceChannelMmMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.AnnounceChannelMmMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('announce_channel_mm');
		$tMap->setPhpName('AnnounceChannelMm');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ANNOUNCE_CHANNEL_ID', 'AnnounceChannelId', 'int' , CreoleTypes::INTEGER, 'announce_channel', 'ID', true, null);

		$tMap->addForeignPrimaryKey('MM_ID', 'MmId', 'int' , CreoleTypes::INTEGER, 'mm', 'ID', true, null);

		$tMap->addColumn('STATUS_ID', 'StatusId', 'int', CreoleTypes::INTEGER, true, null);

	} // doBuild()

} // AnnounceChannelMmMapBuilder
