/* eslint-disable no-var */
const mysql = require('mysql');

function callback(QUERY, masterObjectCopy, stationname, callbackfunc) {
  // db init connetions pool
  const pool = mysql.createPool({
    connectionLimit: 5,
    host: '',
    user: '',
    password: '',
    database: '',
  });

  pool.query(QUERY, (queryError, result, fields) => {
    if (queryError) {
      throw queryError;
    } else if (result.length > 0) {
      callbackfunc(result[0].station_id, masterObjectCopy, pool);
    } else {
      const STATION_NAMES = {
        ebb: 55,
	ebbg3: 66,
        myg: 54,
        makg3: 53,
        kml: 52,
        jja: 50,
        'byd-2': 49,
        'byd-1': 48,
        /** duplicates to bend the rules for naming errors */

        lwgg3: 57,
        jjag: 50,
        mak: 53,
        ebbg3: 52,
        makg2: 53,
        fos: 53,
        fios: 53,
        byd: 48,
        jjag3: 50,
        mygg3: 54,
        jnj: 50,
        klrg3: 56,
        kwd: 71,
      };

      callbackfunc(STATION_NAMES[stationname], masterObjectCopy, pool);
    }
  });
}

module.exports = callback;
