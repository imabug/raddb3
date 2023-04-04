# Raddb3 Design Documentation

# Database schema
The database schema will largely follow the one laid out in raddb
## Models
### Lookup Tables
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
sufficient to uniquely identify each piece of equipment.  Foreign keys
are used to establish the following relations:
    * Location
    * Manufacturer
    * Modality
### Tube
The Tube model contains information about the x-ray tubes associated
with each machine.  Foreign keys are used to establish the following relations:
    * Machine
    * Manufacturer
### TestDate
Date of the testing performed.  Foreign keys are used to establish the
following relations:
    * Machine
    * Tester
    * Test Type
# User Interface
* Use Bootstrap CSS
# API
