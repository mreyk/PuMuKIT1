<?php

/**
 * Base static class for performing query and update operations on the 'mm_person' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseMmPersonPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'mm_person';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.MmPerson';

	/** The total number of columns. */
	const NUM_COLUMNS = 4;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the MM_ID field */
	const MM_ID = 'mm_person.MM_ID';

	/** the column name for the PERSON_ID field */
	const PERSON_ID = 'mm_person.PERSON_ID';

	/** the column name for the ROLE_ID field */
	const ROLE_ID = 'mm_person.ROLE_ID';

	/** the column name for the RANK field */
	const RANK = 'mm_person.RANK';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('MmId', 'PersonId', 'RoleId', 'Rank', ),
		BasePeer::TYPE_COLNAME => array (MmPersonPeer::MM_ID, MmPersonPeer::PERSON_ID, MmPersonPeer::ROLE_ID, MmPersonPeer::RANK, ),
		BasePeer::TYPE_FIELDNAME => array ('mm_id', 'person_id', 'role_id', 'rank', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('MmId' => 0, 'PersonId' => 1, 'RoleId' => 2, 'Rank' => 3, ),
		BasePeer::TYPE_COLNAME => array (MmPersonPeer::MM_ID => 0, MmPersonPeer::PERSON_ID => 1, MmPersonPeer::ROLE_ID => 2, MmPersonPeer::RANK => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('mm_id' => 0, 'person_id' => 1, 'role_id' => 2, 'rank' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/MmPersonMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.MmPersonMapBuilder');
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
			$map = MmPersonPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. MmPersonPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(MmPersonPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(MmPersonPeer::MM_ID);

		$criteria->addSelectColumn(MmPersonPeer::PERSON_ID);

		$criteria->addSelectColumn(MmPersonPeer::ROLE_ID);

		$criteria->addSelectColumn(MmPersonPeer::RANK);

	}

	const COUNT = 'COUNT(mm_person.MM_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT mm_person.MM_ID)';

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
			$criteria->addSelectColumn(MmPersonPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPersonPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = MmPersonPeer::doSelectRS($criteria, $con);
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
	 * @return     MmPerson
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = MmPersonPeer::doSelect($critcopy, $con);
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
		return MmPersonPeer::populateObjects(MmPersonPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseMmPersonPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseMmPersonPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			MmPersonPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

        //ADD DEFAULT ORDER
        if((count($criteria->getOrderByColumns()) == 0) &&
           (array_diff($criteria->getSelectColumns(), array(self::COUNT_DISTINCT, self::COUNT)))) 
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
		$cls = MmPersonPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related Mm table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinMm(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmPersonPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPersonPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPersonPeer::MM_ID, MmPeer::ID);

		$rs = MmPersonPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Person table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinPerson(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmPersonPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPersonPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPersonPeer::PERSON_ID, PersonPeer::ID);

		$rs = MmPersonPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Role table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinRole(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmPersonPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPersonPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPersonPeer::ROLE_ID, RolePeer::ID);

		$rs = MmPersonPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of MmPerson objects pre-filled with their Mm objects.
	 *
	 * @return     array Array of MmPerson objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinMm(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmPersonPeer::addSelectColumns($c);
		$startcol = (MmPersonPeer::NUM_COLUMNS - MmPersonPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MmPeer::addSelectColumns($c);

		$c->addJoin(MmPersonPeer::MM_ID, MmPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPersonPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MmPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getMm(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addMmPerson($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initMmPersons();
				$obj2->addMmPerson($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MmPerson objects pre-filled with their Person objects.
	 *
	 * @return     array Array of MmPerson objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinPerson(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmPersonPeer::addSelectColumns($c);
		$startcol = (MmPersonPeer::NUM_COLUMNS - MmPersonPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PersonPeer::addSelectColumns($c);

		$c->addJoin(MmPersonPeer::PERSON_ID, PersonPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPersonPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PersonPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPerson(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addMmPerson($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initMmPersons();
				$obj2->addMmPerson($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MmPerson objects pre-filled with their Role objects.
	 *
	 * @return     array Array of MmPerson objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinRole(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmPersonPeer::addSelectColumns($c);
		$startcol = (MmPersonPeer::NUM_COLUMNS - MmPersonPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RolePeer::addSelectColumns($c);

		$c->addJoin(MmPersonPeer::ROLE_ID, RolePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPersonPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RolePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getRole(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addMmPerson($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initMmPersons();
				$obj2->addMmPerson($obj1); //CHECKME
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
			$criteria->addSelectColumn(MmPersonPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPersonPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPersonPeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(MmPersonPeer::PERSON_ID, PersonPeer::ID);

		$criteria->addJoin(MmPersonPeer::ROLE_ID, RolePeer::ID);

		$rs = MmPersonPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of MmPerson objects pre-filled with all related objects.
	 *
	 * @return     array Array of MmPerson objects.
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

		MmPersonPeer::addSelectColumns($c);
		$startcol2 = (MmPersonPeer::NUM_COLUMNS - MmPersonPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		PersonPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PersonPeer::NUM_COLUMNS;

		RolePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + RolePeer::NUM_COLUMNS;

		$c->addJoin(MmPersonPeer::MM_ID, MmPeer::ID);

		$c->addJoin(MmPersonPeer::PERSON_ID, PersonPeer::ID);

		$c->addJoin(MmPersonPeer::ROLE_ID, RolePeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPersonPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Mm rows
	
			$omClass = MmPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMm(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMmPerson($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initMmPersons();
				$obj2->addMmPerson($obj1);
			}


				// Add objects for joined Person rows
	
			$omClass = PersonPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPerson(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMmPerson($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initMmPersons();
				$obj3->addMmPerson($obj1);
			}


				// Add objects for joined Role rows
	
			$omClass = RolePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getRole(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addMmPerson($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initMmPersons();
				$obj4->addMmPerson($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Mm table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptMm(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmPersonPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPersonPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPersonPeer::PERSON_ID, PersonPeer::ID);

		$criteria->addJoin(MmPersonPeer::ROLE_ID, RolePeer::ID);

		$rs = MmPersonPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Person table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptPerson(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmPersonPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPersonPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPersonPeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(MmPersonPeer::ROLE_ID, RolePeer::ID);

		$rs = MmPersonPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Role table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptRole(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmPersonPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPersonPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPersonPeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(MmPersonPeer::PERSON_ID, PersonPeer::ID);

		$rs = MmPersonPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of MmPerson objects pre-filled with all related objects except Mm.
	 *
	 * @return     array Array of MmPerson objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptMm(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmPersonPeer::addSelectColumns($c);
		$startcol2 = (MmPersonPeer::NUM_COLUMNS - MmPersonPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PersonPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PersonPeer::NUM_COLUMNS;

		RolePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + RolePeer::NUM_COLUMNS;

		$c->addJoin(MmPersonPeer::PERSON_ID, PersonPeer::ID);

		$c->addJoin(MmPersonPeer::ROLE_ID, RolePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPersonPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PersonPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPerson(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMmPerson($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMmPersons();
				$obj2->addMmPerson($obj1);
			}

			$omClass = RolePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getRole(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMmPerson($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMmPersons();
				$obj3->addMmPerson($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MmPerson objects pre-filled with all related objects except Person.
	 *
	 * @return     array Array of MmPerson objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptPerson(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmPersonPeer::addSelectColumns($c);
		$startcol2 = (MmPersonPeer::NUM_COLUMNS - MmPersonPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		RolePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + RolePeer::NUM_COLUMNS;

		$c->addJoin(MmPersonPeer::MM_ID, MmPeer::ID);

		$c->addJoin(MmPersonPeer::ROLE_ID, RolePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPersonPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MmPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMm(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMmPerson($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMmPersons();
				$obj2->addMmPerson($obj1);
			}

			$omClass = RolePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getRole(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMmPerson($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMmPersons();
				$obj3->addMmPerson($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MmPerson objects pre-filled with all related objects except Role.
	 *
	 * @return     array Array of MmPerson objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptRole(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmPersonPeer::addSelectColumns($c);
		$startcol2 = (MmPersonPeer::NUM_COLUMNS - MmPersonPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		PersonPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PersonPeer::NUM_COLUMNS;

		$c->addJoin(MmPersonPeer::MM_ID, MmPeer::ID);

		$c->addJoin(MmPersonPeer::PERSON_ID, PersonPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPersonPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MmPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMm(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMmPerson($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMmPersons();
				$obj2->addMmPerson($obj1);
			}

			$omClass = PersonPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPerson(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMmPerson($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMmPersons();
				$obj3->addMmPerson($obj1);
			}

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
		return MmPersonPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a MmPerson or Criteria object.
	 *
	 * @param      mixed $values Criteria or MmPerson object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMmPersonPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseMmPersonPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from MmPerson object
		}


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

		
    foreach (sfMixer::getCallables('BaseMmPersonPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseMmPersonPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a MmPerson or Criteria object.
	 *
	 * @param      mixed $values Criteria or MmPerson object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMmPersonPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseMmPersonPeer', $values, $con);
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

			$comparison = $criteria->getComparison(MmPersonPeer::MM_ID);
			$selectCriteria->add(MmPersonPeer::MM_ID, $criteria->remove(MmPersonPeer::MM_ID), $comparison);

			$comparison = $criteria->getComparison(MmPersonPeer::PERSON_ID);
			$selectCriteria->add(MmPersonPeer::PERSON_ID, $criteria->remove(MmPersonPeer::PERSON_ID), $comparison);

			$comparison = $criteria->getComparison(MmPersonPeer::ROLE_ID);
			$selectCriteria->add(MmPersonPeer::ROLE_ID, $criteria->remove(MmPersonPeer::ROLE_ID), $comparison);

		} else { // $values is MmPerson object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseMmPersonPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseMmPersonPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the mm_person table.
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
			$affectedRows += BasePeer::doDeleteAll(MmPersonPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a MmPerson or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or MmPerson object or primary key or array of primary keys
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
			$con = Propel::getConnection(MmPersonPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof MmPerson) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey
			// values
			if(count($values) == count($values, COUNT_RECURSIVE))
			{
				// array is not multi-dimensional
				$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
				$vals[2][] = $value[2];
			}

			$criteria->add(MmPersonPeer::MM_ID, $vals[0], Criteria::IN);
			$criteria->add(MmPersonPeer::PERSON_ID, $vals[1], Criteria::IN);
			$criteria->add(MmPersonPeer::ROLE_ID, $vals[2], Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given MmPerson object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      MmPerson $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(MmPerson $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MmPersonPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MmPersonPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(MmPersonPeer::DATABASE_NAME, MmPersonPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = MmPersonPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param int $mm_id
	   @param int $person_id
	   @param int $role_id
	   
	 * @param      Connection $con
	 * @return     MmPerson
	 */
	public static function retrieveByPK( $mm_id, $person_id, $role_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(MmPersonPeer::MM_ID, $mm_id);
		$criteria->add(MmPersonPeer::PERSON_ID, $person_id);
		$criteria->add(MmPersonPeer::ROLE_ID, $role_id);
		$v = MmPersonPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseMmPersonPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseMmPersonPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/MmPersonMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.MmPersonMapBuilder');
}
