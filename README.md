## About Challenge Idea

User Transactions API
This API allows you to retrieve user transactions from multiple payment providers, such as DataProviderX and DataProviderY.


## To Run Project 
 
* docker-compose up --build -d && docker exec -it parent-app bash deploy/start.sh 

## Project  Target

- Code quality
- Application performance in reading large files
- Code scalability : ability to add DataProviderZ by small changes
- Unit tests coverage
- Docker

## Project Details

+ Project Make Dynamic Component For New Provider 
+ JSON Machine is an efficient, easy-to-use and fast JSON stream/pull/incremental/lazy
+  Repository Pattern and Facade
+  UnitTest For Seperated Provider
+ Docker


### Add New Component

- Just add New DataProvider(?) path =>  Helper /JsonFile /DataProvider/ Classes
- Add New File Storage For Json Data and From Class Built Call It
- You Can Add New Filter 
  +  ( Global - specific )
  +  Every Class Have Filter Separated  as You Want

### Add New TestCases
- Just add new Separated Class As You want

###  Docker 
+ Folder deploy + docker-compose.yml ( container_name -> parent-app)



