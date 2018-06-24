# DB_final
> Deadline 6/29 23:59
---
## Left to be done
* event status for admin users
* bonus(edit)
* regist checking

## Schema
* user {
    id (int, auto inc, primary key),
    student_id (varchar(7)),
    email (varchar(255)),
    password (varchar(255)),
    name (varchar(255))
  }

* announces {
    ann_id (int, auto inc, primary key),
    title (varchar(255)),
    content (text),
    ann_date (current timestamp)
  }

* event {
    event_id (int, auto inc, primary key),
    name (varchar(255)),
    date (date),
    mem_limit (int),
    team_limit (int),
    rule (text)
  }
  
* signs {
    sign_id (int, auto inc, primary key),
    team_id (varchar(255)),
    student_id (varchar(7)),
    event_id (int)
  }

* teams {
    team_id (int, auto inc, primary key),
    team_name (varchar(255)),
    for_event (int)
  }