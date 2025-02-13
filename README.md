# CSIS 270 & CSIS240 - Group Project
## Inwousluga - A Web Application That Allows Users to Provide, Consume, and Interact with Each Other's Services

### Members of the group:
- Nijaz Andelić
- Alen Bejtić
- Haris Mustabašić

### Professors:
- Amer Hadžikadić
- Bakir Husović

---

## Contents
1. [Inwousluga](#inwousluga)
2. [Introduction (Abstract + Introduction)](#1-introduction-abstract--introduction)
3. [Project Implementation](#2-project-implementation)
   - [2.1 SDLC](#21-sdlc)
   - [2.2 DBLC](#22-dblc)
   - [2.3 Strategy](#23-strategy)
   - [2.4 Data Dictionary](#24-data-dictionary)
   - [2.5 Queries](#25-queries)
   - [2.6 Triggers](#26-triggers)
   - [2.7 Procedures](#27-procedures)
   - [2.8 Views](#28-views)
4. [Future Improvements](#3-future-improvements)
5. [Lessons Learned](#4-lessons-learned)

---

## Inwousluga
### A Web Application That Allows Users to Provide, Consume, and Interact with Each Other's Services

### 1. Introduction (Abstract + Introduction)
Inwousluga is a project aimed at solving common problems - finding skilled masters or service providers. Currently, in Bosnia and Herzegovina, most good masters and service providers come through recommendations if they are even available. Many of the best masters leave for other countries in search of better pay and more work. Whether our application will retain tradesmen remains to be seen, but it will certainly filter the best masters and service providers and help people find the right person for any needed service (masters, photography, mascots, etc.). We have tried to create the most viable project so that users can already use the application. If the application proves successful, future strategic plans can be found in the future work section. As for us as developers, one of the outcomes is definitely the improvement of our Git and GitHub utilization as well as testing our PHP skills along with HTML and CSS skills. Without good design, the product cannot grow, so we faced that challenge and came up with the best version of the envisioned design.

As already mentioned, Inwousluga is a web application accessible without any downloads; simply enter the URL in a web browser. The aim of the application is to make finding people who provide certain services as easy as possible. The application is a minimum viable product (MVP) which means it is not yet finished and has plenty of room for improvement. The MVP was necessary to test the application, see if people would be satisfied with it, and estimate its usage.

In the application, if a user has an account, they can choose a category and then, under that category, select a specific service where all the people offering that service will be displayed. The user can collaborate with the service provider by requesting collaboration, which the service provider can accept or decline. If accepted, the collaboration status will remain active until the service provider marks it as completed. Once this is done, the user who hired the service provider can rate and leave a comment.
Additionally, the user can like services and leave personal comments on the liked service for easier reference later. Every user can also become a service provider by adding a specific service. They will then appear on the list of service providers, and people can collaborate with them. A super user or admin has the ability to view all users, categories, services, and service providers, and manage their data. This means the admin must be a strict and responsible person as they handle sensitive information.

Generally, the application includes:
- User accounts
- Collaboration among users
- Display of all necessary data to the admin user
- Ability to like (save) services and comment on them for future collaboration
- Ability to rate and add comments to a service

The application contains the following pages:
- A form for creating user accounts
- A form for entering services
- A page displaying all categories from which a tradesman can be (e.g., home repairs, electrical work, material processing, etc.)
- A page displaying all services related to that category (e.g., in the home repairs category you can find services like electricians, plumbers, painters, tilers, etc.)
- A page displaying all the people offering a service (e.g., in the electrician service there is Murkof Electrician)
- A page displaying a specific person providing a service (e.g., Murkof Electrician with a description of their work, overall user rating, location, phone number, etc.)
- A page showing all upcoming, requested, and current collaborations
- A profile editing page
- An admin page

### 2. Project Implementation
#### 2.1 SDLC
Inwousluga is an information system because it consists of people, databases, hardware, software, procedures, and rules. For this reason, we used the Systems Development Life Cycle (SDLC) approach to create this application. Naturally, we employed an iterative process.

The SDLC is divided into five phases:
1. Planning
2. Analysis
3. Detailed Systems Design
4. Implementation
5. Maintenance

#### 2.1.1 Planning
As with any good and quality start, it was necessary to describe the application and document every possible detail, then create a strategy and even a business plan. This was probably the most iterative process because we had to focus on just one idea from a million possibilities and choose the essential parts, leaving the rest for "later." We defined the goals of our application and, since we didn't have any system in place, we researched the competition and found it to be weak, so creating a new system was the right choice.

#### 2.1.2 Analysis
After defining the business, we conducted a more detailed analysis to determine how to "reach" our target users, encourage people to use the application, and attract the best tradesmen to sign up and offer their services. With advice from Mr. Amer Hadžikadić, we performed a live example with a few people to observe their behavior. As a result, our plan and analysis were revised, business rules were finalized, and the ERD design was constructed. The Database Life Cycle description will be in a separate section. After reviewing the collected data, we confirmed that creating this application was worth it and began design and development.

#### 2.1.3 Detailed systems design
Finally, after all the writing and planning, it was time to get to work. We started with simple sketches on paper and then moved to FigJam. At the same time, we brainstormed ideas for the logo and selected colors and fonts for the application.

Logo:

![Logo](logo.png)

Colors:
- Primary: #8437FB
- Secondary: #351664

Font:
- Main Font: Montserrat

Following the well-defined rules in the Analysis statement greatly helped us, and with the aid of the textual "image," we were able to create an accurate "visual" image.

Of course, graphical and UI design are not the only aspects of the application's design process. Here we also created the processes and steps that the system will follow. For every input, we made corresponding outputs in the form of test cases. Additionally, we thoroughly described the database attributes and improved the relationships between tables. We defined triggers, views, and procedures. When everything is combined, we have a fully designed product, leaving only the implementation.

#### 2.1.4 Implementation
We divided the roles and started working. Nijaz, a team member, focused on the full-stack application, ensuring that the frontend and backend were well integrated and that the application had a smooth flow. Alen participated in the backend process along with the construction and development of the database and everything related to it, with assistance from Haris. It's worth mentioning that all three members collaboratively designed the logo and the UI.

##### 2.1.4.1 Technologies
- IDE and Text Editors:
  - Visual Studio Code
  - PhpStorm
- Database:
  - MySQL (uploaded to Oracle MySQL HeatWave)
- Programming & Coding Languages:
  - HTML
  - CSS
  - PHP
  - JavaScript
- Security:
  - MySQL Parameters
  - Password hashing
- Additional Technologies:
  - ChatGPT4o
  - Pexels
  - Unsplash
  - Dribble
  - Behance
  - Pinterest
  - Ideogram
  - Discord
  - Git
  - GitHub
  - Xamp

In the application, we aimed to minimize the amount of JavaScript code and we ultimately finished with fewer than 200 lines of JavaScript, which is a good result. We used JavaScript only for tasks where it was necessary, such as AJAX requests to make the form's select fields dynamic.

The application aimed to minimize repetitive code (DRY Principle). For every reusable piece of code, such as service-row, category, footer, header, service, site-header, db, and others, a PHP file was created as well as a folder containing its CSS. The coding process continued until the last day alongside testing and debugging.

#### 2.2 DBLC
Every application needs a database. There are processes and methods for creating a well-structured database and everything related to it. For this reason, we used the Database Life Cycle (DBLC), which defines the exact stages that a database system must go through from its initial concept to the end of its life. The DBLC ensures that databases are well-developed, implemented, maintained, and organized.

DBLC has 6 phases:
1. Database initial study
2. Database design
3. Implementation and loading
4. Testing and evaluation
5. Operation
6. Maintenance and evolution

#### 2.2.1 Database initial study
In this process, the first step is to analyze the state of the company. Since we are just starting, it is necessary to define all problems and potential threats. Additionally, we need to define the scopes and boundaries. Like any engineering endeavor, we "broke down" the problem into smaller parts to understand the nature of the problem better. In our case, the "problem" was how to achieve a multi-tenant system where each user could both add a service and use other users' services. To conclude that we needed a multi-tenant system, we first had to thoroughly describe our business and break down the problems into smaller parts. The key question was whether to create separate profiles for users and service providers or to integrate them into one. In the end, we chose the latter option.

#### 2.2.2 Database Design
In this process, we had to create business rules for both developers and users. If you're wondering why we needed two sets of rules, it's because the perspective of a developer and the perspective of a user regarding the database are not the same. Therefore, we had to design twice: rules for developers to ease our development process and rules for users to facilitate using the application. At this point, we already established some data flow.

Database design also has its processes. We went through the conceptual design. Everything mentioned so far is part of the database analysis and requirements of the conceptual design.

After that, we moved on to the second stage of Conceptual Database Design, which is Entity Relationship Modelling and normalization. As the title suggests, we constructed an ERD diagram. This was an iterative process. The final version of the ERD diagram was confirmed by the top industry expert Mr. Amer Hadžikadić. Following this, there was no need for further normalization, although we later encountered one redundant attribute which was fortunately insignificant and easily removed.

We decided to use a MySQL database on Oracle MySQL HeatWave, and we would connect to it using the XAMPP MySQL server. The database was uploaded as an instance on Oracle to allow all users to access it and to avoid data migration issues.

#### 2.2.3 Implementation and loading
In the database, it was necessary to create DDL as well as SQL queries. The queries also needed to be tested. Additionally, it was necessary to "populate" the database with existing data and insert new data if available. Since we were developing a new program, we only inserted the necessary data to test whether everything was functioning correctly.

#### 2.3 Strategy
It's important to note that we used a top-down approach, meaning we first defined the tables, specifically the entity sets, and then the data for those entity sets. Initially, the entries were Users, Service, Category, and Collaboration. Since we determined that a many-to-many relationship was needed between users and services, we had to add the provider service entity. On Mr. Hadžikadić's advice, we also added the Liked Service entity. After that, we defined all the attributes for each table along with their types. One of the more interesting attributes is Status in the Collaboration table, which is of the enum type and can have values 'p', 'a', and 'f'. Status 'p' indicates that the collaboration is pending. Status 'a' indicates that the collaboration is active, and Status 'f' indicates that the collaboration has finished.

#### 2.4 Data Dictionary
1. **Category**
   - CID: INT Auto Increment Primary Key
   - Category_Type: VARCHAR(255) Not Null
   - Created_At: TIMESTAMP Default CURRENT_TIMESTAMP

2. **Service**
   - SID: INT Auto Increment Primary Key
   - Service_Name: VARCHAR(255) Not Null
   - Service_Description: TEXT Null
   - Category_ID: INT Foreign Key

3. **Users**
   - UID: INT Auto Increment Primary Key
   - First_Name: VARCHAR(255) Not Null
   - Last_Name: VARCHAR(255) Not Null
   - DOB: DATE Null
   - Phone: VARCHAR(15) Null
   - Email: VARCHAR(255) Null
   - Password: VARCHAR(255) Not Null
   - Total_Rating: FLOAT Null
   - IsAdmin: TINYINT(1) Default 0 Null

4. **Provider_Service**
   - PSID: INT Auto Increment Primary Key
   - Total_Service_Rating: FLOAT Null
   - Name_Of_Service: VARCHAR(255) Not Null
   - Location: VARCHAR(255) Null
   - Telephone_Number: VARCHAR(15) Null
   - Description: TEXT Null
   - Website: VARCHAR(255) Null
   - Email: VARCHAR(255) Null
   - User_ID: INT Foreign Key
   - Service_ID: INT Foreign Key
   - Image: BLOB Null

5. **Collaboration**
   - CID: INT Auto Increment Primary Key
   - Status: ENUM ('p', 'a', 'f') Not Null
   - Review: INT Null
   - Comment: TEXT Null
   - Service_User_Message: TEXT Null
   - Worked_Hours: INT Null
   - Collaboration_Started: TIMESTAMP Default CURRENT_TIMESTAMP Null
   - Collaboration_Finished: TIMESTAMP Null
   - User_ID: INT Foreign Key
   - Provider_Service_ID: INT Foreign Key
   - Date_Requested: TIMESTAMP Not Null

6. **Liked_Service**
   - LSID: INT Auto Increment Primary Key
   - Comment: TEXT Null
   - Date_Liked: TIMESTAMP Default CURRENT_TIMESTAMP Null
   - User_ID: INT Foreign Key
   - Provider_Service_ID: INT Foreign Key

#### 2.5 Queries
1. **Retrieve Active Collaborations for Service Provider** (I am service provider at that moment)

The query is designed to fetch all active collaborations for the currently logged-in service provider, displaying relevant information from multiple related tables. The results include the first name, last name, and user ID of the user who initiated the collaboration, along with all details from the collaboration, provider_service, and service tables. This comprehensive data can be used to manage ongoing collaborations and provide a detailed view of user interactions and service details.

2. **Retrieve Active Collaborations for Logged-in User** (I am requesting a service provider at that moment)

The query is designed to fetch all active collaborations for the currently logged-in user, displaying relevant information from multiple related tables. The results include the first name, last name, and user ID of the service provider, along with all details from the collaboration, provider_service, and service tables. This comprehensive data can be used to manage ongoing collaborations and provide a detailed view of interactions and service details. Specifically, it helps the logged-in user (likely a client or service requester) to see which active services they are currently engaged in, who the service providers are, and details about the services being provided.

3. **Search Categories by Category Type**

The query is useful for implementing search functionality within a web application, allowing users to find categories based on partial or full matches of their input. This can enhance the user experience by providing relevant search results, even if the user does not know the exact category name.

4. **Insert New Collaboration Request**

The purpose of this query is to create a new entry in the collaboration table to record a user's request to collaborate on a service. It helps to track collaboration requests, including the message from the user, the user who requested it, the service involved, and the date and time of the request. This information is crucial for managing and processing collaboration requests within the application.

5. **Update User Information**

The purpose of this query is to update a user's profile information in the database. This operation is essential for allowing users to keep their personal information up-to-date. The WHERE UID = '$uid' condition ensures that only the specified user's record is updated.

#### 2.6 Triggers
Triggers automate certain actions to maintain data consistency and integrity without requiring manual intervention.

By defining triggers to execute before or after specific events (like insert, update, delete), these automated processes ensure fields like timestamps and average ratings are always up-to-date. These triggers update timestamps on category edits, recalculate average ratings for users and services after collaboration records are modified, and compute worked hours when collaboration records are updated.

#### 2.7 Procedures
Procedures and functions simplify complex operations and ensure consistency by encapsulating logic that can be reused throughout the application. Procedures are called to perform specific tasks (like inserting or updating records), while functions return values based on input parameters (like retrieving a user's full name). `AddOrUpdateProviderService` handles inserting new records or updating existing ones in the provider_service table, and `GetFullUserName` returns a user's full name by concatenating their first and last names.

#### 2.8 Views
Views provide a simplified way to access data from multiple tables without needing to write complex join queries each time. By defining a view, complex joins and queries can be pre-written and stored, allowing for easy and efficient data retrieval. The `ServiceDetails` view joins the service and category tables, providing a comprehensive dataset that includes service details along with their respective categories, streamlining data access and query efficiency.

### 3. Future Improvements
It has already been emphasized that this project is an MVP, which means it has tremendous potential for upgrades.

#### 3.1 Frontend
1. **Like/Dislike Functionality**
   - Feature: Implement the ability to like and dislike a service by clicking on the heart icon.
   - Benefit: Enhances user interaction and engagement with the services.
2. **Comment Visibility and Interaction**
   - Feature: Display all comments below the user profile and allow comments to be replied to, similar to Facebook posts.
   - Benefit: Facilitates better communication and feedback among users.
3. **UI Design Enhancements**
   - Feature: Improve the color palette to be more user-friendly and familiar to users.
   - Benefit: Creates a more visually appealing and comfortable user experience.
4. **Comment Editing Improvements**
   - Feature: Replace the current comment editing inputs.
   - Benefit: Provides a more intuitive and efficient way for users to edit their comments.
5. **Landing Page Creation**
   - Feature: Develop a landing page to promote the application with a call-to-action button leading to the main page.
   - Benefit: Attracts new users and provides a clear entry point to the application.
6. **Image Upload and Profile Editing**
   - Feature: Enable users to add images and enhance the profile editing functionality.
   - Benefit: Allows for richer user profiles and better personalization.
7. **Enhanced User Data Display**
   - Feature: Display more detailed user information such as the total number of services offered, total completed collaborations, and other relevant data.
   - Benefit: Provides users with a comprehensive view of their activity and accomplishments on the platform.

These upgrades aim to significantly enhance the user experience, improve engagement, and provide additional functionalities to make the platform more robust and user-friendly.

#### 3.2 Backend
1. **Adopt Modern PHP Practices**
   - Objective: Utilize object-oriented programming (OOP) in PHP and modern PHP syntax.
   - Benefit: Improves code organization, reusability, and maintainability.
2. **Enhance Code Reusability**
   - Objective: Refactor frontend components to reduce duplicate code.
   - Benefit: Streamlines the codebase, making it easier to manage and extend.
3. **Optimize Comments and Documentation**
   - Objective: Remove unnecessary comments and thoroughly comment on important sections of the code.
   - Benefit: Keeps the codebase clean and helps developers understand critical parts of the code more easily.
4. **Improve Variable Naming**
   - Objective: Use more descriptive and meaningful variable names.
   - Benefit: Enhances code readability and makes it easier for developers to understand the purpose of each variable.
5. **Create Functions for Repeated Code**
   - Objective: Identify repeated code blocks and encapsulate them into reusable functions.
   - Benefit: Reduces redundancy, simplifies code maintenance, and improves modularity.

#### 3.3 Database
1. **Optimize Queries**
   - Objective: Refactor and optimize SQL queries to improve performance and efficiency.
   - Benefit: Reduces load times and enhances the overall performance of the application.
2. **Utilize Views**
   - Objective: Better leverage SQL views to simplify complex queries and improve data abstraction.
   - Benefit: Enhances readability and maintainability of SQL queries by encapsulating complex logic in views.
3. **Add More Triggers**
   - Objective: Implement additional database triggers to automate tasks and enforce data integrity.
   - Benefit: Ensures consistency and automates routine tasks within the database.
4. **Create Many-to-Many Relationships for Admins and Other Tables**
   - Objective: Establish a many-to-many relationship between admins and all other tables to track historical data and logs.
   - Benefit: Enhances security and accountability by tracking which admin performed specific actions, providing a clear audit trail.

#### 3.4 Business
1. **Implement Chat Functionality**
   - Objective: Add real-time chat functionality for users to communicate with each other.
   - Benefit: Enhances user interaction and collaboration, making the application more engaging.
2. **User Posts and Blogs**
   - Objective: Allow users to create posts and blogs to share updates, tips, and experiences.
   - Benefit: Fosters a community atmosphere and encourages content sharing and user engagement.
3. **Ranking System and Competition**
   - Objective: Develop a ranking system to display user competition and motivate better performance.
   - Benefit: Encourages quality service and active participation by providing motivation through competition.
4. **Rewards for Top-ranked Providers**
   - Objective: Offer rewards, such as premium features, to the best-ranked service providers.
   - Benefit: motivates providers to maintain high standards and improve their services.
5. **Mobile Application Development**
   - Objective: Create a mobile version of the application for both iOS and Android platforms.
   - Benefit: Increases accessibility and convenience for users, allowing them to use the application on-the-go.
6. **Real-time Functionality**
   - Objective: Implement real-time updates to avoid the need for page reloads.
   - Benefit: Enhances user experience by providing instantaneous updates and interactions.

### 4. Lessons Learned
In this project, we learned a lot, and the most important lesson is that anything is possible with determination. The process of creating this application was not exactly simple. It required a lot of planning and evaluation just to make the MVP. Nevertheless, we learned the importance of sitting down and planning a project before starting to code, and that planning is the most crucial process. With a good plan in place, 30-40% of the work is already done.

Throughout this project and the Databases course, we learned how to create excellent ERDs and normalize them, making the handling of complex queries much easier. We mastered PHP during the Web course, and we believe it is time to transition to Laravel. Overall, this project has been a great experience that has certainly boosted our confidence as developers, enhanced our egos, and motivated us to work even harder and better. If we can accomplish such things now, imagine what we can achieve with more knowledge. One of the key takeaways from this project is the importance of starting and finishing tasks on time.

