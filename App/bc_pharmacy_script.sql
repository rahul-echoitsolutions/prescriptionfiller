update pharmacy set city = regexp_replace( regexp_replace(address, ', bc.+?canada', ''), '.+?(ave| st| rd| ave.| avenue| ctr.| dr| street| hwy| st.| drive| blvd| way| road| crossing| highway| hwy.| way| pky| parkway| blvd.| crescent| pky| pwky| rd.| dr.| broadway| lane| centre| cres.| cres| kingsway) ', '');

update pharmacy set city = replace(city, 'w ', '');


LOAD DATA LOCAL INFILE  
'/tmp/pharmacy.csv'
INTO TABLE pharmacy
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
(id, phone_number, fax_number, address, zip_code, name, latitude, longitude, city,province);


update pharmacy set name = replace(name, "\n", '');



update pharmacy set phone_number = replace(phone_number, '+', '');
update pharmacy set phone_number = replace(phone_number, '(', '');
update pharmacy set phone_number = replace(phone_number, ')', '');
update pharmacy set phone_number = replace(phone_number, '-', '');
update pharmacy set phone_number = replace(phone_number, ' ', '');

update pharmacy set fax_number = replace(fax_number, '+', '');
update pharmacy set fax_number = replace(fax_number, '(', '');
update pharmacy set fax_number = replace(fax_number, ')', '');
update pharmacy set fax_number = replace(fax_number, '-', '');
update pharmacy set fax_number = replace(fax_number, ' ', '');

update pharmacy set zip_code = replace(zip_code, ' ', '');


update pharmacy 
INNER JOIN canadian_postal_codes ON canadian_postal_codes.postal_code = pharmacy.zip_code
set pharmacy.latitude = canadian_postal_codes.latitude, pharmacy.longitude = canadian_postal_codes.longitude;
