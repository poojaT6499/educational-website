## CRUD status:
### Admin (DONE)
- banner
- classes
- subject
- chapters
- questions
- enrollments
- notes
- doubt_sessions
- test
- written_submissions
- mcq_submissions
- written_results
- mcq_results
- notifications

### Teachers (DONE)
- chapters
- doubt session
- enrollment
- mcq submission
- media
- notes
- question

## DIRECT DB changes (Not in migrations):
### Table: teacher_class
- classes_id (class_id to classes_id)

### Table: doubt_sessions
- type (i.e. 0 - Doubt Session, 1 - Live Lec)       ---- add this column

### Table ADDED: test_question
#### columns:
- id
- test_id
- question_id 

### Table MODIFIEd: mcq_results
- make mcq_submission_id **nullable**

### Table MODIFIEd: written_results
- make written_submission_id **nullable**

### Table MODIFIEd: mcq_submissions
- make option_id **nullable**