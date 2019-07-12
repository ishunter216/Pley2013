Please read README.md first for a project installation instructions.

PleyBox is a subscription business, which delivers customer a certain box in a subscription line at a given period
of time.

Each subscription line consists of certain boxes, and box consists of certain item set.

Goal of the test task is:
- Implement an API endpoint, which can be used for creation of a new box and it's items in a subscription line
- As a successful result this endpoint should create a
nd relate all the necessary database entries, mentioned in a SQL queries
- This is an admin endpoint, so should be provided by a controller within namespace ```operations\v1``` and require authentication
- Endpoint should accept only POST requests with a JSON payload
- Endpoint should respond with JSON payload for both success and failure cases
- You can see which data is necessary for the item creation from the supplied SQL queries, feel free to design the payload as you wish
- please follow the existing code style and data model
- please find a ```DB_dump.sql.zip``` in a root folder of project
- you will also have an access to the admin Angular application. Feel free to explore.

Currently new box can be created with the set of following raw SQL queries:
```
#create a box in items table
INSERT INTO item (name, description, length_cm, width_cm, height_cm, weight_gr, created_at, updated_at)
VALUES ('Multiprincess Box', 'Multiprincess Box', 25,25 , 23, 930, NULL, NULL);

#create item parts in item_parts table
## Create item with sizes assigned (shirt)
INSERT INTO item_part (item_id, name, type_item_part_id, is_need_mod, image, created_at, updated_at) VALUES
  ({RELATION item_id}, 'Multiprincess Tshirt', 2, 1,
   'http://via.placeholder.com/350x150',
   NULL, NULL);

##create other items
INSERT INTO item_part (item_id, name, type_item_part_id, is_need_mod, image, created_at, updated_at) VALUES
  ({RELATION item_id}, 'Multiprincess Swim Googles', 1, 0,
   'http://via.placeholder.com/350x150',
   NULL, NULL);

INSERT INTO item_part (item_id, name, type_item_part_id, is_need_mod, image, created_at, updated_at) VALUES
  ({RELATION item_id}, 'Multiprincess Sling Bag', 1, 0,
   'http://via.placeholder.com/350x150',
   NULL, NULL);

INSERT INTO item_part (item_id, name, type_item_part_id, is_need_mod, image, created_at, updated_at) VALUES
  ({RELATION item_id}, 'Multiprincess  Canteen', 1, 0,
   'http://via.placeholder.com/350x150',
   NULL, NULL);

INSERT INTO item_part (item_id, name, type_item_part_id, is_need_mod, image, created_at, updated_at) VALUES
  ({RELATION item_id}, 'Multiprincess Blanket (Var. 1)', 1, 0,
   'http://via.placeholder.com/350x150',
   NULL, NULL);

INSERT INTO item_part (item_id, name, type_item_part_id, is_need_mod, image, created_at, updated_at) VALUES
  ({RELATION item_id}, 'Multiprincess  Hair Accessories (Var. 1)', 1, 0,
   'http://via.placeholder.com/350x150',
   NULL, NULL);

INSERT INTO item_part (item_id, name, type_item_part_id, is_need_mod, image, created_at, updated_at) VALUES
  ({RELATION item_id}, 'Multiprincess Nesting Dolls (Var. 2)', 1, 0,
   'http://via.placeholder.com/350x150',
   NULL, NULL);

INSERT INTO item_part (item_id, name, type_item_part_id, is_need_mod, image, created_at, updated_at) VALUES
  ({RELATION item_id}, 'Multiprincess  Cards (Var. 2)', 1, 0,
   'http://via.placeholder.com/350x150',
   NULL, NULL);

# insert stock values for a CONFIGURABLE shirt item_part type
INSERT INTO item_part_stock (item_id, item_part_id, type_item_part_id, type_item_part_source_id, inducted_stock, stock, created_at, updated_at)
VALUES ({RELATION item_id}, {RELATION item_part_id}, 2, 2, 3000 , 3000 , NULL, NULL);
INSERT INTO item_part_stock (item_id, item_part_id, type_item_part_id, type_item_part_source_id, inducted_stock, stock, created_at, updated_at)
VALUES ({RELATION item_id}, {RELATION item_part_id}, 2, 3, 3000 , 3000 , NULL, NULL);
INSERT INTO item_part_stock (item_id, item_part_id, type_item_part_id, type_item_part_source_id, inducted_stock, stock, created_at, updated_at)
VALUES ({RELATION item_id}, {RELATION item_part_id}, 2, 4, 3000 , 3000 , NULL, NULL);
INSERT INTO item_part_stock (item_id, item_part_id, type_item_part_id, type_item_part_source_id, inducted_stock, stock, created_at, updated_at)
VALUES ({RELATION item_id}, {RELATION item_part_id}, 2, 5, 3000 , 3000 , NULL, NULL);


#insert stock values for a NON-CONFIGURABLE item_part type
INSERT INTO item_part_stock (item_id, item_part_id, type_item_part_id, type_item_part_source_id, inducted_stock, stock, created_at, updated_at)
VALUES ({RELATION item_id}, {RELATION item_part_id}, 1, 0, 3000 , 3000 , NULL, NULL);
INSERT INTO item_part_stock (item_id, item_part_id, type_item_part_id, type_item_part_source_id, inducted_stock, stock, created_at, updated_at)
VALUES ({RELATION item_id}, {RELATION item_part_id}, 1, 0, 3000 , 3000 , NULL, NULL);
INSERT INTO item_part_stock (item_id, item_part_id, type_item_part_id, type_item_part_source_id, inducted_stock, stock, created_at, updated_at)
VALUES ({RELATION item_id}, {RELATION item_part_id}, 1, 0, 3000 , 3000 , NULL, NULL);
INSERT INTO item_part_stock (item_id, item_part_id, type_item_part_id, type_item_part_source_id, inducted_stock, stock, created_at, updated_at)
VALUES ({RELATION item_id}, {RELATION item_part_id}, 1, 0, 3000 , 3000 , NULL, NULL);
INSERT INTO item_part_stock (item_id, item_part_id, type_item_part_id, type_item_part_source_id, inducted_stock, stock, created_at, updated_at)
VALUES ({RELATION item_id}, {RELATION item_part_id}, 1, 0, 3000 , 3000 , NULL, NULL);
INSERT INTO item_part_stock (item_id, item_part_id, type_item_part_id, type_item_part_source_id, inducted_stock, stock, created_at, updated_at)
VALUES ({RELATION item_id}, {RELATION item_part_id}, 1, 0, 3000 , 3000 , NULL, NULL);
INSERT INTO item_part_stock (item_id, item_part_id, type_item_part_id, type_item_part_source_id, inducted_stock, stock, created_at, updated_at)
VALUES ({RELATION item_id}, {RELATION item_part_id}, 1, 0, 3000 , 3000 , NULL, NULL);

#add a subscription relation
INSERT INTO subscription_item (subscription_id, item_id) VALUES (1, {RELATION item_id});
```



