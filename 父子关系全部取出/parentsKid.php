儿子找爸爸:
比如层次关系有5层,就右链表5次
SELECT t5.id,t1.name AS lev1, t2.name as lev2, t3.name as lev3, t4.name as lev4,t5.name as lev5
FROM yzz_housing_resources AS t1
right JOIN yzz_housing_resources AS t2 ON  t2.parent_id = t1.id
right JOIN yzz_housing_resources AS t3 ON 	t3.parent_id = t2.id
right JOIN yzz_housing_resources AS t4 ON 	t4.parent_id = t3.id
right JOIN yzz_housing_resources AS t5 ON 	t5.parent_id = t4.id
WHERE t5.id IN (28447);

爸爸找儿子:
SELECT t1.id,t1.name AS lev1, t2.name as lev2, t3.name as lev3, t4.name as lev4,t5.name as lev5
FROM yzz_housing_resources AS t1
left JOIN yzz_housing_resources AS t2 ON  t2.parent_id = t1.id
left JOIN yzz_housing_resources AS t3 ON 	t3.parent_id = t2.id
left JOIN yzz_housing_resources AS t4 ON 	t4.parent_id = t3.id
left JOIN yzz_housing_resources AS t5 ON 	t5.parent_id = t4.id
WHERE t1.id IN (28447);


其实他们就相差在 right 和 left ,还有where条件的表id
