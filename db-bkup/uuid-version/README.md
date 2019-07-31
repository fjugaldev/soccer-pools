# MYSQL 5.7 VERSION
No existe la función UUID_TO_BIN ni BIN_TO_UUID por lo que hay que crear las siguientes funciones:

```sql
CREATE FUNCTION uuid_to_bin(uuid CHAR(36))
  RETURNS binary(16)
  DETERMINISTIC
RETURN UNHEX(CONCAT(
  SUBSTRING(uuid,7,2),SUBSTRING(uuid,5,2),SUBSTRING(uuid,3,2),SUBSTRING(uuid,1,2),
  SUBSTRING(uuid,12,2),SUBSTRING(uuid,10,2),
  SUBSTRING(uuid,17,2),SUBSTRING(uuid,15,2),
  SUBSTRING(uuid,20,4),
  SUBSTRING(uuid,25,12)
  ));
```
````sql
CREATE FUNCTION bin_to_uuid(uuid binary(16))
  RETURNS CHAR(36)
  DETERMINISTIC
RETURN LOWER(CONCAT(
    SUBSTR(HEX(uuid), 1, 8), '-',
    SUBSTR(HEX(uuid), 9, 4), '-',
    SUBSTR(HEX(uuid), 13, 4), '-',
    SUBSTR(HEX(uuid), 17, 4), '-',
    SUBSTR(HEX(uuid), 21)
));
````

## Si queremos usar Ordered UUID Binary
```sql
CREATE 
  FUNCTION `uuid_to_ouuid`(uuid BINARY(36))
  RETURNS binary(16) DETERMINISTIC
  RETURN UNHEX(CONCAT(
  SUBSTR(uuid, 15, 4),
  SUBSTR(uuid, 10, 4),
  SUBSTR(uuid, 1, 8),
  SUBSTR(uuid, 20, 4),
  SUBSTR(uuid, 25, 12)
));
```

```sql
CREATE 
  FUNCTION ouuid_to_uuid(uuid BINARY(16))
  RETURNS VARCHAR(36)
  RETURN LOWER(CONCAT(
  SUBSTR(HEX(uuid), 9, 8), '-',
  SUBSTR(HEX(uuid), 5, 4), '-',
  SUBSTR(HEX(uuid), 1, 4), '-',
  SUBSTR(HEX(uuid), 17,4), '-',
  SUBSTR(HEX(uuid), 21, 12 )
));
```

#MYSQL 8.0 VERSION

Usar las funciones nativas de BIN_TO_UUID() y UUID_TO_BIN()

Generador de UUID() Online
https://www.uuidgenerator.net/version4

# Regex para reemplazar en PHPSTORM:

Find: 
````text
// Find: UNHEX(REPLACE("006f0507-37ce-4f3f-83fa-38d751f1bd6e", "-",""))
UNHEX\(REPLACE\("(.*)", "-",""\)\) 
````

Replace with:
````text
// Replaces to: //UUID_TO_BIN('006f0507-37ce-4f3f-83fa-38d751f1bd6e')
UUID_TO_BIN('$1')
````
