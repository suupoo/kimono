# テーブル定義書 

2024年09月15日 18時33分00秒

このファイルは自動生成されたファイルです。

# cache

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| key | varchar(255) | NO | PRI |  |  | select,insert,update,references |  |
| value | mediumtext | NO |  |  |  | select,insert,update,references |  |
| expiration | int(11) | NO |  |  |  | select,insert,update,references |  |

# cache_locks

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| key | varchar(255) | NO | PRI |  |  | select,insert,update,references |  |
| owner | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| expiration | int(11) | NO |  |  |  | select,insert,update,references |  |

# companies

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| owner_sequence_no | int(11) | YES | MUL |  |  | select,insert,update,references |  |
| owner_system_company | bigint(20) unsigned | YES | MUL |  |  | select,insert,update,references |  |
| name | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| tags | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| created_at | datetime | YES |  |  |  | select,insert,update,references |  |
| created_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| updated_at | datetime | YES |  |  |  | select,insert,update,references |  |
| updated_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| deleted_at | datetime | YES |  |  |  | select,insert,update,references |  |
## キー制約

### 外部キー制約

| Constraint | Column | Reference | Comment |
| --- | --- | --- | --- |
| companies_owner_system_company_foreign | owner_system_company |  |  |

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| companies_owner_company_sequence_no_unique | owner_sequence_no |  |
| companies_owner_company_sequence_no_unique | owner_system_company |  |

# customers

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| owner_sequence_no | int(11) | YES | MUL |  |  | select,insert,update,references |  |
| owner_system_company | bigint(20) unsigned | YES | MUL |  |  | select,insert,update,references |  |
| customer_name | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| prefecture | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| post_code | varchar(10) | YES |  |  |  | select,insert,update,references |  |
| address_1 | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| address_2 | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| note | longtext | YES |  |  |  | select,insert,update,references |  |
| tags | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| created_at | datetime | YES |  |  |  | select,insert,update,references |  |
| created_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| updated_at | datetime | YES |  |  |  | select,insert,update,references |  |
| updated_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| deleted_at | datetime | YES |  |  |  | select,insert,update,references |  |
## キー制約

### 外部キー制約

| Constraint | Column | Reference | Comment |
| --- | --- | --- | --- |
| customers_owner_system_company_foreign | owner_system_company |  |  |

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| customers_owner_company_sequence_no_unique | owner_sequence_no |  |
| customers_owner_company_sequence_no_unique | owner_system_company |  |

# failed_jobs

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| uuid | varchar(255) | NO | UNI |  |  | select,insert,update,references |  |
| connection | text | NO |  |  |  | select,insert,update,references |  |
| queue | text | NO |  |  |  | select,insert,update,references |  |
| payload | longtext | NO |  |  |  | select,insert,update,references |  |
| exception | longtext | NO |  |  |  | select,insert,update,references |  |
| failed_at | timestamp | NO |  | current_timestamp() |  | select,insert,update,references |  |
## キー制約

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| failed_jobs_uuid_unique | uuid |  |

# features

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| name | varchar(255) | NO | MUL |  |  | select,insert,update,references |  |
| scope | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| value | text | NO |  |  |  | select,insert,update,references |  |
| created_at | timestamp | YES |  |  |  | select,insert,update,references |  |
| updated_at | timestamp | YES |  |  |  | select,insert,update,references |  |
## キー制約

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| features_name_scope_unique | name |  |
| features_name_scope_unique | scope |  |

# job_batches

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | varchar(255) | NO | PRI |  |  | select,insert,update,references |  |
| name | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| total_jobs | int(11) | NO |  |  |  | select,insert,update,references |  |
| pending_jobs | int(11) | NO |  |  |  | select,insert,update,references |  |
| failed_jobs | int(11) | NO |  |  |  | select,insert,update,references |  |
| failed_job_ids | longtext | NO |  |  |  | select,insert,update,references |  |
| options | mediumtext | YES |  |  |  | select,insert,update,references |  |
| cancelled_at | int(11) | YES |  |  |  | select,insert,update,references |  |
| created_at | int(11) | NO |  |  |  | select,insert,update,references |  |
| finished_at | int(11) | YES |  |  |  | select,insert,update,references |  |

# jobs

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| queue | varchar(255) | NO | MUL |  |  | select,insert,update,references |  |
| payload | longtext | NO |  |  |  | select,insert,update,references |  |
| attempts | tinyint(3) unsigned | NO |  |  |  | select,insert,update,references |  |
| reserved_at | int(10) unsigned | YES |  |  |  | select,insert,update,references |  |
| available_at | int(10) unsigned | NO |  |  |  | select,insert,update,references |  |
| created_at | int(10) unsigned | NO |  |  |  | select,insert,update,references |  |

# m_system_administrator_companies

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| system_administrator | bigint(20) unsigned | NO |  |  |  | select,insert,update,references |  |
| system_company | bigint(20) unsigned | NO |  |  |  | select,insert,update,references |  |

# m_system_administrators

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| name | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| email | varchar(255) | NO | UNI |  |  | select,insert,update,references |  |
| email_verified_at | timestamp | YES |  |  |  | select,insert,update,references |  |
| password | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| image | text | YES |  |  |  | select,insert,update,references |  |
| role | varchar(255) | NO |  | normal |  | select,insert,update,references |  |
| remember_token | varchar(100) | YES |  |  |  | select,insert,update,references |  |
| start_at | datetime | YES |  |  |  | select,insert,update,references | 利用開始日 |
| end_at | datetime | YES |  |  |  | select,insert,update,references | 利用終了日 |
| created_at | datetime | YES |  |  |  | select,insert,update,references |  |
| created_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| updated_at | datetime | YES |  |  |  | select,insert,update,references |  |
| updated_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
## キー制約

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| administrators_email_unique | email |  |

# m_system_banners

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| image | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| text | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| url | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| priority | smallint(6) | YES |  |  |  | select,insert,update,references |  |
| created_at | datetime | YES |  |  |  | select,insert,update,references |  |
| created_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| updated_at | datetime | YES |  |  |  | select,insert,update,references |  |
| updated_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |

# m_system_companies

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| uuid | char(36) | YES | UNI |  |  | select,insert,update,references | UUID |
| name | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| conoha_tenant_username | text | YES |  |  |  | select,insert,update,references | Conohaユーザ名 |
| conoha_tenant_password | text | YES |  |  |  | select,insert,update,references | Conohaテナントパスワード |
| conoha_tenant_name | text | YES |  |  |  | select,insert,update,references | Conohaテナント名 |
| conoha_tenant_id | text | YES |  |  |  | select,insert,update,references | ConohaテナントID |
| conoha_tenant_temporary_url_key | text | YES |  |  |  | select,insert,update,references | Conohaテナント名 |
| conoha_container_name | text | YES |  |  |  | select,insert,update,references | Conohaコンテナ名 |
| created_at | datetime | YES |  |  |  | select,insert,update,references |  |
| updated_at | datetime | YES |  |  |  | select,insert,update,references |  |
## キー制約

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| m_system_companies_uuid_unique | uuid |  |

# m_system_features

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| key | varchar(255) | NO | PRI |  |  | select,insert,update,references |  |
| name | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| enable | tinyint(1) | NO |  |  |  | select,insert,update,references |  |
| flag_switch | tinyint(1) | NO |  | 0 |  | select,insert,update,references |  |

# migrations

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | int(10) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| migration | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| batch | int(11) | NO |  |  |  | select,insert,update,references |  |

# notifications

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| owner_sequence_no | int(11) | YES | MUL |  |  | select,insert,update,references |  |
| owner_system_company | bigint(20) unsigned | YES | MUL |  |  | select,insert,update,references |  |
| title | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| type | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| content | longtext | NO |  |  |  | select,insert,update,references |  |
| publish_at | datetime | YES |  |  |  | select,insert,update,references |  |
| status | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| tags | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| created_at | datetime | YES |  |  |  | select,insert,update,references |  |
| created_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| updated_at | datetime | YES |  |  |  | select,insert,update,references |  |
| updated_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| deleted_at | datetime | YES |  |  |  | select,insert,update,references |  |
## キー制約

### 外部キー制約

| Constraint | Column | Reference | Comment |
| --- | --- | --- | --- |
| notifications_owner_system_company_foreign | owner_system_company |  |  |

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| notifications_owner_company_sequence_no_unique | owner_sequence_no |  |
| notifications_owner_company_sequence_no_unique | owner_system_company |  |

# password_reset_tokens

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| email | varchar(255) | NO | PRI |  |  | select,insert,update,references |  |
| token | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| created_at | timestamp | YES |  |  |  | select,insert,update,references |  |

# personal_access_tokens

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| tokenable_type | varchar(255) | NO | MUL |  |  | select,insert,update,references |  |
| tokenable_id | bigint(20) unsigned | NO |  |  |  | select,insert,update,references |  |
| name | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| token | varchar(64) | NO | UNI |  |  | select,insert,update,references |  |
| abilities | text | YES |  |  |  | select,insert,update,references |  |
| last_used_at | timestamp | YES |  |  |  | select,insert,update,references |  |
| expires_at | timestamp | YES |  |  |  | select,insert,update,references |  |
| created_at | timestamp | YES |  |  |  | select,insert,update,references |  |
| updated_at | timestamp | YES |  |  |  | select,insert,update,references |  |
## キー制約

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| personal_access_tokens_token_unique | token |  |

# sessions

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | varchar(255) | NO | PRI |  |  | select,insert,update,references |  |
| user_id | bigint(20) unsigned | YES | MUL |  |  | select,insert,update,references |  |
| ip_address | varchar(45) | YES |  |  |  | select,insert,update,references |  |
| user_agent | text | YES |  |  |  | select,insert,update,references |  |
| payload | longtext | NO |  |  |  | select,insert,update,references |  |
| last_activity | int(11) | NO | MUL |  |  | select,insert,update,references |  |

# staffs

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| owner_sequence_no | int(11) | YES | MUL |  |  | select,insert,update,references |  |
| owner_system_company | bigint(20) unsigned | YES | MUL |  |  | select,insert,update,references |  |
| name | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| image | text | YES |  |  |  | select,insert,update,references |  |
| code | varchar(255) | YES | UNI |  |  | select,insert,update,references |  |
| email | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| tel | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| position | varchar(255) | YES |  |  |  | select,insert,update,references | 役職 |
| join_date | date | YES |  |  |  | select,insert,update,references | 入社日 |
| quit_date | date | YES |  |  |  | select,insert,update,references | 退社日 |
| tags | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| created_at | datetime | YES |  |  |  | select,insert,update,references |  |
| created_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| updated_at | datetime | YES |  |  |  | select,insert,update,references |  |
| updated_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| deleted_at | datetime | YES |  |  |  | select,insert,update,references |  |
## キー制約

### 外部キー制約

| Constraint | Column | Reference | Comment |
| --- | --- | --- | --- |
| staffs_owner_system_company_foreign | owner_system_company |  |  |

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| staffs_code_unique | code |  |
| staffs_owner_company_sequence_no_unique | owner_sequence_no |  |
| staffs_owner_company_sequence_no_unique | owner_system_company |  |

# stocks

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| owner_sequence_no | int(11) | YES | MUL |  |  | select,insert,update,references |  |
| owner_system_company | bigint(20) unsigned | YES | MUL |  |  | select,insert,update,references |  |
| image | text | YES |  |  |  | select,insert,update,references |  |
| name | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| price | int(11) | NO |  |  |  | select,insert,update,references |  |
| quantity | int(11) | NO |  |  |  | select,insert,update,references |  |
| tags | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| created_at | datetime | YES |  |  |  | select,insert,update,references |  |
| created_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| updated_at | datetime | YES |  |  |  | select,insert,update,references |  |
| updated_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| deleted_at | datetime | YES |  |  |  | select,insert,update,references |  |
## キー制約

### 外部キー制約

| Constraint | Column | Reference | Comment |
| --- | --- | --- | --- |
| stocks_owner_system_company_foreign | owner_system_company |  |  |

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| stocks_owner_company_sequence_no_unique | owner_sequence_no |  |
| stocks_owner_company_sequence_no_unique | owner_system_company |  |

# stores

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| owner_sequence_no | int(11) | YES | MUL |  |  | select,insert,update,references |  |
| owner_system_company | bigint(20) unsigned | YES | MUL |  |  | select,insert,update,references |  |
| name | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| prefecture | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| post_code | varchar(10) | YES |  |  |  | select,insert,update,references |  |
| address_1 | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| address_2 | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| code | varchar(255) | NO | UNI |  |  | select,insert,update,references |  |
| tags | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| created_at | datetime | YES |  |  |  | select,insert,update,references |  |
| created_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| updated_at | datetime | YES |  |  |  | select,insert,update,references |  |
| updated_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| deleted_at | datetime | YES |  |  |  | select,insert,update,references |  |
## キー制約

### 外部キー制約

| Constraint | Column | Reference | Comment |
| --- | --- | --- | --- |
| stores_owner_system_company_foreign | owner_system_company |  |  |

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| stores_code_unique | code |  |
| stores_owner_company_sequence_no_unique | owner_sequence_no |  |
| stores_owner_company_sequence_no_unique | owner_system_company |  |

# stores_staffs

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| store_id | bigint(20) unsigned | NO | MUL |  |  | select,insert,update,references |  |
| staff_id | bigint(20) unsigned | NO |  |  |  | select,insert,update,references |  |
## キー制約

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| stores_staffs_store_id_staff_id_unique | store_id |  |
| stores_staffs_store_id_staff_id_unique | staff_id |  |

# system_email_verifications

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| model | varchar(255) | NO | MUL |  |  | select,insert,update,references |  |
| models_id | bigint(20) unsigned | NO |  |  |  | select,insert,update,references |  |
| email | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| token | text | NO |  |  |  | select,insert,update,references |  |
| is_verified | tinyint(1) | YES |  | 0 |  | select,insert,update,references |  |
| created_at | datetime | YES |  |  |  | select,insert,update,references |  |
| expired_at | datetime | YES |  |  |  | select,insert,update,references |  |
## キー制約

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| system_email_verifications_model_token_unique | model |  |
| system_email_verifications_model_token_unique | token |  |

# system_logging_access_ip_addresses

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| uuid | char(36) | NO | PRI |  |  | select,insert,update,references |  |
| m_system_administrator_id | bigint(20) unsigned | NO |  |  |  | select,insert,update,references |  |
| ip_address | varchar(255) | NO |  |  |  | select,insert,update,references | IPアドレス |
| user_agent | text | YES |  |  |  | select,insert,update,references | ユーザーエージェント |
| created_at | datetime | YES |  |  |  | select,insert,update,references |  |
| updated_at | datetime | YES |  |  |  | select,insert,update,references |  |

# users

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| owner_sequence_no | int(11) | YES | MUL |  |  | select,insert,update,references |  |
| owner_system_company | bigint(20) unsigned | YES | MUL |  |  | select,insert,update,references |  |
| name | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| email | varchar(255) | NO | UNI |  |  | select,insert,update,references |  |
| email_verified_at | timestamp | YES |  |  |  | select,insert,update,references |  |
| password | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| remember_token | varchar(100) | YES |  |  |  | select,insert,update,references |  |
| tags | varchar(255) | YES |  |  |  | select,insert,update,references |  |
| created_at | timestamp | YES |  |  |  | select,insert,update,references |  |
| created_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| updated_at | timestamp | YES |  |  |  | select,insert,update,references |  |
| updated_user | bigint(20) | YES |  |  |  | select,insert,update,references |  |
| deleted_at | datetime | YES |  |  |  | select,insert,update,references |  |
## キー制約

### 外部キー制約

| Constraint | Column | Reference | Comment |
| --- | --- | --- | --- |
| users_owner_system_company_foreign | owner_system_company |  |  |

### ユニークキー制約

| Constraint | Column | Comment |
| --- | --- | --- |
| users_email_unique | email |  |
| users_owner_company_sequence_no_unique | owner_sequence_no |  |
| users_owner_company_sequence_no_unique | owner_system_company |  |

# verifications

## カラム一覧

| Field | Type | Null | Key | Default | Extra | Privileges | Comment |
| --- | --- | --- | --- | --- | --- | --- | --- |
| id | bigint(20) unsigned | NO | PRI |  | auto_increment | select,insert,update,references |  |
| uuid | char(36) | NO |  |  |  | select,insert,update,references |  |
| email | varchar(255) | NO |  |  |  | select,insert,update,references |  |
| token | text | NO |  |  |  | select,insert,update,references |  |
| created_at | datetime | NO |  |  |  | select,insert,update,references |  |
| expired_at | datetime | NO |  |  |  | select,insert,update,references |  |
