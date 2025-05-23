INSERT INTO carritos (id, user_id, created_at, updated_at)
VALUES (
    'id:bigint',
    'user_id:bigint',
    'created_at:timestamp',
    'updated_at:timestamp'
  );INSERT INTO users (
    id,
    name,
    apellidos,
    dni,
    pasaporte,
    email,
    email_verified_at,
    password,
    telefono,
    rol,
    urlImg,
    creditos,
    remember_token,
    created_at,
    updated_at
  )
VALUES (
    'id:bigint',
    'name:varchar',
    'apellidos:varchar',
    'dni:varchar',
    'pasaporte:varchar',
    'email:varchar',
    'email_verified_at:timestamp',
    'password:varchar',
    'telefono:varchar',
    'rol:enum',
    'urlImg:varchar',
    'creditos:decimal',
    'remember_token:varchar',
    'created_at:timestamp',
    'updated_at:timestamp'
  );SELECT 
    TABLE_NAME,
    COLUMN_NAME,
    DATA_TYPE,
    CHARACTER_MAXIMUM_LENGTH,
    IS_NULLABLE,
    COLUMN_KEY,
    COLUMN_DEFAULT,
    EXTRA
FROM 
    information_schema.COLUMNS
WHERE 
    TABLE_SCHEMA = 'dss';