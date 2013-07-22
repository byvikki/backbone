use mydb;
SELECT Data_TYPE, table_name, COLUMN_NAME FROM information_schema.columns where DATA_TYPE='TEXT' and TABLE_SCHEMA='mydb' order by 2;