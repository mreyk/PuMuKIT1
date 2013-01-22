<?php

/**
 * Base static class for performing query and update operations on the 'virtual_ground' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseVirtualGroundPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'virtual_ground';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.VirtualGround';

	/** The total number of columns. */
	const NUM_COLUMNS = 11;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'virtual_ground.ID';

	/** the column name for the COD field */
	const COD = 'virtual_ground.COD';

	/** the column name for the DISPLAY field */
	const DISPLAY = 'virtual_ground.DISPLAY';

	/** the column name for the RANK field */
	const RANK = 'virtual_ground.RANK';

	/** the column name for the DESCRIPTION field */
	const DESCRIPTION = 'virtual_ground.DESCRIPTION';

	/** the column name for the IMG field */
	const IMG = 'virtual_ground.IMG';

	/** the column name for the EDITORIAL1 field */
	const EDITORIAL1 = 'virtual_ground.EDITORIAL1';

	/** the column name for the EDITORIAL2 field */
	const EDITORIAL2 = 'virtual_ground.EDITORIAL2';

	/** the column name for the EDITORIAL3 field */
	const EDITORIAL3 = 'virtual_ground.EDITORIAL3';

	/** the column name for the OTHER field */
	const OTHER = 'virtual_ground.OTHER';

	/** the column name for the GROUND_TYPE_ID field */
	const GROUND_TYPE_ID = 'virtual_ground.GROUND_TYPE_ID';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Cod', 'Display', 'Rank', 'Description', 'Img', 'Editorial1', 'Editorial2', 'Editorial3', 'Other', 'GroundTypeId', ),
		BasePeer::TYPE_COLNAME => array (VirtualGroundPeer::ID, VirtualGroundPeer::COD, VirtualGroundPeer::DISPLAY, VirtualGroundPeer::RANK, VirtualGroundPeer::DESCRIPTION, VirtualGroundPeer::IMG, VirtualGroundPeer::EDITORIAL1, VirtualGroundPeer::EDITORIAL2, VirtualGroundPeer::EDITORIAL3, VirtualGroundPeer::OTHER, VirtualGroundPeer::GROUND_TYPE_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'cod', 'display', 'rank', 'description', 'img', 'editorial1', 'editorial2', 'editorial3', 'other', 'ground_type_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Cod' => 1, 'Display' => 2, 'Rank' => 3, 'Description' => 4, 'Img' => 5, 'Editorial1' => 6, 'Editorial2' => 7, 'Editorial3' => 8, 'Other' => 9, 'GroundTypeId' => 10, ),
		BasePeer::TYPE_COLNAME => array (VirtualGroundPeer::ID => 0, VirtualGroundPeer::COD => 1, VirtualGroundPeer::DISPLAY => 2, VirtualGroundPeer::RANK => 3, VirtualGroundPeer::DESCRIPTION => 4, VirtualGroundPeer::IMG => 5, VirtualGroundPeer::EDITORIAL1 => 6, VirtualGroundPeer::EDITORIAL2 => 7, VirtualGroundPeer::EDITORIAL3 => 8, VirtualGroundPeer::OTHER => 9, VirtualGroundPeer::GROUND_TYPE_ID => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'cod' => 1, 'display' => 2, 'rank' => 3, 'description' => 4, 'img' => 5, 'editorial1' => 6, 'editorial2' => 7, 'editorial3' => 8, 'other' => 9, 'ground_type_id' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/VirtualGroundMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.VirtualGroundMapBuilder');
	}
	/**
	 * Gets a map (hash) of PHP names to DB column names.
	 *
	 * @return     array The PHP to DB name map for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @deprecated Use the getFieldNames() and translateFieldName() methods instead of this.
	 */
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = VirtualGroundPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants TYPE_PHPNAME,
	 *                         TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants TYPE_PHPNAME,
	 *                      TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. VirtualGroundPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(VirtualGroundPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(VirtualGroundPeer::ID);

		$criteria->addSelectColumn(VirtualGroundPeer::COD);

		$criteria->addSelectColumn(VirtualGroundPeer::DISPLAY);

		$criteria->addSelectColumn(VirtualGroundPeer::RANK);

		$criteria->addSelectColumn(VirtualGroundPeer::DESCRIPTION);

		$criteria->addSelectColumn(VirtualGroundPeer::IMG);

		$criteria->addSelectColumn(VirtualGroundPeer::EDITORIAL1);

		$criteria->addSelectColumn(VirtualGroundPeer::EDITORIAL2);

		$criteria->addSelectColumn(VirtualGroundPeer::EDITORIAL3);

		$criteria->addSelectColumn(VirtualGroundPeer::OTHER);

		$criteria->addSelectColumn(VirtualGroundPeer::GROUND_TYPE_ID);

	}

	const COUNT = 'COUNT(virtual_ground.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT virtual_ground.ID)';

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VirtualGroundPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VirtualGroundPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = VirtualGroundPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      Connection $con
	 * @return     VirtualGround
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = VirtualGroundPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return VirtualGroundPeer::populateObjects(VirtualGroundPeer::doSelectRS($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect()
	 * method to get a ResultSet.
	 *
	 * Use this method directly if you want to just get the resultset
	 * (instead of an array of objects).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     ResultSet The resultset object with numerically-indexed fields.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseVirtualGroundPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseVirtualGroundPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			VirtualGroundPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

        //ADD DEFAULT ORDER
        $criteria->addAscendingOrderByColumn(self::RANK);

		// BasePeer returns a Creole ResultSet, set to return
		// rows indexed numerically.
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = VirtualGroundPeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related GroundType table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinGroundType(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VirtualGroundPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VirtualGroundPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VirtualGroundPeer::GROUND_TYPE_ID, GroundTypePeer::ID);

		$rs = VirtualGroundPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of VirtualGround objects pre-filled with their GroundType objects.
	 *
	 * @return     array Array of VirtualGround objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinGroundType(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VirtualGroundPeer::addSelectColumns($c);
		$startcol = (VirtualGroundPeer::NUM_COLUMNS - VirtualGroundPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		GroundTypePeer::addSelectColumns($c);

		$c->addJoin(VirtualGroundPeer::GROUND_TYPE_ID, GroundTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VirtualGroundPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = GroundTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getGroundType(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addVirtualGround($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initVirtualGrounds();
				$obj2->addVirtualGround($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(VirtualGroundPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(VirtualGroundPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(VirtualGroundPeer::GROUND_TYPE_ID, GroundTypePeer::ID);

		$rs = VirtualGroundPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of VirtualGround objects pre-filled with all related objects.
	 *
	 * @return     array Array of VirtualGround objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		VirtualGroundPeer::addSelectColumns($c);
		$startcol2 = (VirtualGroundPeer::NUM_COLUMNS - VirtualGroundPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		GroundTypePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + GroundTypePeer::NUM_COLUMNS;

		$c->addJoin(VirtualGroundPeer::GROUND_TYPE_ID, GroundTypePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = VirtualGroundPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined GroundType rows
	
			$omClass = GroundTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getGroundType(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addVirtualGround($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initVirtualGrounds();
				$obj2->addVirtualGround($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


  /**
   * Selects a collection of VirtualGround objects pre-filled with their i18n objects.
   *
   * @return array Array of VirtualGround objects.
   * @throws PropelException Any exceptions caught during processing will be
   *     rethrown wrapped into a PropelException.
   */
  public static function doSelectWithI18n(Criteria $c, $culture = null, $con = null)
  {
    // we're going to modify criteria, so copy it first
    $c = clone $c;
    if ($culture === null)
    {
      $culture = sfContext::getInstance()->getUser()->getCulture();
    }

    // Set the correct dbName if it has not been overridden
    if ($c->getDbName() == Propel::getDefaultDB())
    {
      $c->setDbName(self::DATABASE_NAME);
    }

    VirtualGroundPeer::addSelectColumns($c);
    $startcol = (VirtualGroundPeer::NUM_COLUMNS - VirtualGroundPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    VirtualGroundI18nPeer::addSelectColumns($c);

    $c->addJoin(VirtualGroundPeer::ID, VirtualGroundI18nPeer::ID);
    $c->add(VirtualGroundI18nPeer::CULTURE, $culture);

    $c->addAscendingOrderByColumn(self::RANK);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = VirtualGroundPeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = VirtualGroundI18nPeer::getOMClass($rs, $startcol);

      $cls = Propel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setVirtualGroundI18nForCulture($obj2, $culture);
      $obj2->setVirtualGround($obj1);

      $results[] = $obj1;
    }
    return $results;
  }

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return VirtualGroundPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a VirtualGround or Criteria object.
	 *
	 * @param      mixed $values Criteria or VirtualGround object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseVirtualGroundPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseVirtualGroundPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from VirtualGround object
		}

		$criteria->remove(VirtualGroundPeer::ID); // remove pkey col since this table uses auto-increment


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseVirtualGroundPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseVirtualGroundPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a VirtualGround or Criteria object.
	 *
	 * @param      mixed $values Criteria or VirtualGround object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseVirtualGroundPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseVirtualGroundPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(VirtualGroundPeer::ID);
			$selectCriteria->add(VirtualGroundPeer::ID, $criteria->remove(VirtualGroundPeer::ID), $comparison);

		} else { // $values is VirtualGround object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseVirtualGroundPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseVirtualGroundPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the virtual_ground table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += VirtualGroundPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(VirtualGroundPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a VirtualGround or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or VirtualGround object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      Connection $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(VirtualGroundPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof VirtualGround) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(VirtualGroundPeer::ID, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += VirtualGroundPeer::doOnDeleteCascade($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * This is a method for emulating ON DELETE CASCADE for DBs that don't support this
	 * feature (like MySQL or SQLite).
	 *
	 * This method is not very speedy because it must perform a query first to get
	 * the implicated records and then perform the deletes by calling those Peer classes.
	 *
	 * This method should be used within a transaction if possible.
	 *
	 * @param      Criteria $criteria
	 * @param      Connection $con
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	protected static function doOnDeleteCascade(Criteria $criteria, Connection $con)
	{
		// initialize var to track total num of affected rows
		$affectedRows = 0;

		// first find the objects that are implicated by the $criteria
		$objects = VirtualGroundPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/VirtualGroundI18n.php';

			// delete related VirtualGroundI18n objects
			$c = new Criteria();
			
			$c->add(VirtualGroundI18nPeer::ID, $obj->getId());
			$affectedRows += VirtualGroundI18nPeer::doDelete($c, $con);

			include_once 'lib/model/VirtualGroundRelation.php';

			// delete related VirtualGroundRelation objects
			$c = new Criteria();
			
			$c->add(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, $obj->getId());
			$affectedRows += VirtualGroundRelationPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	/**
	 * Validates all modified columns of given VirtualGround object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      VirtualGround $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(VirtualGround $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(VirtualGroundPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(VirtualGroundPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(VirtualGroundPeer::DATABASE_NAME, VirtualGroundPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = VirtualGroundPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     VirtualGround
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(VirtualGroundPeer::DATABASE_NAME);

		$criteria->add(VirtualGroundPeer::ID, $pk);


		$v = VirtualGroundPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(VirtualGroundPeer::ID, $pks, Criteria::IN);
			$objs = VirtualGroundPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

	/**
	 * Retrieve a single object by pkey with their i18n objects.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     VirtualGround
	 */
	public static function retrieveByPKWithI18n($pk, $culture = null, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(VirtualGroundPeer::DATABASE_NAME);

		$criteria->add(VirtualGroundPeer::ID, $pk);


		$v = VirtualGroundPeer::doSelectWithI18n($criteria, $culture, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys with their i18n objects.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKsWithI18n($pks, $culture = null, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(VirtualGroundPeer::ID, $pks, Criteria::IN);
			$objs = VirtualGroundPeer::doSelectWithI18n($criteria, $culture, $con);
		}
		return $objs;
	}

} // BaseVirtualGroundPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseVirtualGroundPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/VirtualGroundMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.VirtualGroundMapBuilder');
}
