# RadDB3 Design Documentation

# Overview
RadDB3 is a re-write of RadDB with the goal of adopting a test-driven
development approach.  

RadDB3 is an inventory tracking and management program designed for
x-ray imaging equipment and testt equipment.

# Database schema
The database schema will largely follow the DB schema used in RadDB.
Instead of [MariaDB](https://mariadb.org/), RadDB3 will use
[SQLite](https://sqlite.org/index.html) for the database backend.

## Models
### Lookup Tables
The lookup tables are lists that are not expected to change much over
time.  They are properties referenced by other models.

#### Location
Facilities where imaging equipment is used.

#### Manufacturer
Equipment manufacturers

#### Modality
Imaging modalities

#### Tester
List of people that performed the test

#### TestType
List of test types that can be performed.

### Machine
The Machine model contains information about the imaging unit or test
equipment being tracked.  The information stored needs to be
sufficient to uniquely identify each piece of equipment.

Foreign keys are used to establish the following relations:
    * Location
    * Manufacturer
    * Modality
    * Tube

### Tube
The Tube model contains information about the x-ray tubes associated
with each machine.  There can be multiple tubes associted with each
machine, and tubes can be deleted or marked deleted as they are
replaced.

Foreign keys are used to establish the following relations:
    * Machine
    * Manufacturer

### TestDate
Date of the testing performed.  Foreign keys are used to establish the
following relations:
    * Machine
    * Tester
    * Test Type

# Interface
* Use Bootstrap CSS
# API
