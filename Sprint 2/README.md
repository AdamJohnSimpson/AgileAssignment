# Sprint 2

All information about your first sprint should be put into this folder. Additionally, the information below should be updated to give a short summary of your daily scrum meetings.

---

## Day [1] - Scrum Meeting summary
The Scrum Master for this meeting was **Holly Groves**

### Members Present:
Adam Shepherd, Adam Simpson, Beth Ogilvy, Craig Ritchie, Euan Taylor, Holly Groves and Scott Fulton

### Members Not Present:
n/a

### Apologies:
n/a

### Summary of Conversation:
**Previous Tasks**
- We conducted our sprint planning from 9:00am - 11:00am and started Sprint 2 at 11:00am

**Issues**
- The issue we were having is with our pull requests. Since we have to have things on master so we can test them, there are a lot of small pull requests instead of large feature based ones. We looked into solutions such as MAMP (https://www.mamp.info/en/windows/), however we just decided to stick with our current method for this sprint to save time, but in future we will use this instead.

**Today's Tasks**
- Adam Sh: continue trying to be able to export the questionnaire data as a .csv file, if completed will then work on visualising data in a bar graph
- Adam Si/Beth: adding the slight adjustments that came as a result of sprint 1 review (moving/adding buttons), work on creating multiple choice questions in a questionnaire
- Craig: working on being able to display usability scale questions
- Euan: adding a checkbox to indicate whether or not the participent has filled out an ethics form
- Holly: create the show individual results page and get it to be able to show individual repsonses
- Scott: working on being able to add timestamps to videos


---

## Day [2] - Scrum Meeting summary
The Scrum Master for this meeting was **Holly Groves**

### Members Present:
Adam Shepherd, Adam Simpson, Beth Ogilvy, Craig Ritchie, Euan Taylor, Holly Groves and Scott Fulton

### Members Not Present:
n/a

### Apologies:
n/a

### Summary of Conversation:
**Yesterday's Tasks**
- Adam Sh: finished being able to export to a .csv file and created a page to show all response answers to a questionnaire (text answers, single choice, multiple choice), which is all linked to the website. Started work on visualisng the data in a bar graph
- Adam Si/Beth: adding being able to create multiple choice, single choice questions in a questionnaire
- Craig: added a copy to clipboard button, usability scale questions can now be displayed in questionnaires and have their answers stored in a seperate database
- Euan: done the ethics form and ethics form checkbox on the questionnaire, if the checkbox isn't checked then it will direct you to the ethics form
- Holly: created a page to list individal responses for a questionnaire and then a page to display the answers from individual pages (text answers, single choice, multiple choice), all linked to the website
- Scott: started working on adding timestamps to videos

**Issues**
- no major issues from the day before, just the usual smaller php problems.

**Today's Tasks**
- Adam Sh: add being able to show all responses for a usability scale question, work on being able to visualise all data in a bar graph
- Adam Si/Beth: add being able to create usability scale questions
- Craig: allow primary researchers to add and remove coresearchers on their experiments
- Euan: add being able to add transcripts along with videos and have them displayed with the video
- Holly: add being able to show individual responses for a usability scale question, work on being able to play videos in sync with each other
- Scott: continue work on adding timestamps and adding notes to time stamps


---

## Day [3] - Scrum Meeting summary
The Scrum Master for this meeting was **Holly Groves**

### Members Present:
Adam Shepherd, Adam Simpson, Beth Ogilvy, Craig Ritchie, Euan Taylor, Holly Groves and Scott Fulton

### Members Not Present:
n/a

### Apologies:
n/a

### Summary of Conversation:
**Yesterday's Tasks**
- Adam Sh: started work on adding bar graphs to visualise all responses for a questionnaire (including usability scale)
- Adam Si/Beth: finished being able to do usability scale question (pair programming video)
- Craig: added ability to let principle researchers add/remove coresearchers from their experiment
- Euan: can add transcript to the database, needs to be linked to videos
- Holly: started work on being able to display individal usability scale questions results and started trying to get playing in sync videos to work
- Scott: working on being able to add timestamps to videos and comments along with the time stamps

**Issues**
- We had a big issue yesterday that meant our website would stop updating, which occured around 3:00pm so no one could continue any work after this time. Yesterday we tried many solutions, such as redeploying, commenting out code, relinking the github to azure and deleting files. However we eventually realised before this meeting that somehow the build type on azure had switched so instead of carrying out the build in azure it was trying to do it on github, which wasn't working and hence not updating. We have hopefully solved this now.

**Today's Tasks**
- Adam Sh: continue trying to get bar graphs on the website to visualise data
- Adam Si/Beth/Scott: rearranging the way videos and timestamps/transcipts are stored and working on getting time stamps working
- Craig: working on letting coresearchers see the experiments the have been added to but not allow them to add/remove coreseachers
- Euan: working on adding transcripts to a database so it links to the videos
- Holly: continue working on syncing videos and getting usability responses to display no that has finished


---

## Day [4] - Scrum Meeting summary
The Scrum Master for this meeting was **Holly Groves**

### Members Present:
Adam Shepherd, Adam Simpson, Beth Ogilvy, Craig Ritchie, Euan Taylor, Holly Groves and Scott Fulton

### Members Not Present:
n/a

### Apologies:
n/a

### Summary of Conversation:
**Yesterday's Tasks**
- Adam Sh: n/a
- Adam Si/Euan: changed the way video transcripts and descriptions are done and added edit description and edit transcript functionalities, created an additional page to display a sinlge video and its information
- Beth: n/a
- Craig: coreaschers can only see experiments they are linked to
- Holly: videos can be be played and paused in sync (all videos for an experiment)
- Scott: n/a

For n/a tasks see issues below for the reason why


**Issues**
- The problem we had stated yesterday with Azure not updating and our team not being able to use the website was actually **NOT FIXED** yesterday like we thought. The fix yesterday was another problem we accidentally created when repeadtedly redeploying the website to get it to update. We thought it might be the code itself causing the problems, namely it seeemd to break as changes were being made to the same page (videoPage.php) and this happened 3 times in a row. After trying a further variety of possible solutions yesterday we left it over night after we completely lost access to the website and database. This morning before the meeting we tried again to make a new instance  of the webapp on azure (yesterday it was not giving us permission to create a new resource group). After the team member creating the new instance left the old resource group and activiated their student subscription from the university, it allowed us to create a new webapp and connect properly. We had copied the database from the previous site however the database needed relinked, urls in our code needed changed, our old test data needed deleted/recreated and the videos we had uploaded needed reuploaded. This took a lot of time out from our sprint but hopefully this is the permanent solution and we can continue finishing off the tasks we had planned to do. 

**Today's Tasks**
- Adam Sh: continue working on visualsing all data in graphs
- Adam Si/Euan: add the functionality to display the description and transcripts of videos 
- Beth/Scott: work on being able to add timestamps to videos
- Craig: minor fixes across website, and missing stakeholder requirements
- Holly: get usability scale responses to display individually

---

## Day [5] - Scrum Meeting summary
The Scrum Master for this meeting was **Holly Groves**

### Members Present:
Adam Shepherd, Adam Simpson, Beth Ogilvy, Craig Ritchie, Euan Taylor, Holly Groves and Scott Fulton

### Members Not Present:
n/a

### Apologies:
n/a

### Summary of Conversation:
**Yesterday's Tasks**
- Adam Sh: got usability scale results to be visualised
- Adam Si/Euan: finished being able to display and edit transcripts and description for videos
- Beth/Scott: added being able to add timestamps and notes to those time stamps for videos
- Craig: when exporting data to a .csv it will now export usability scale questions as well, added proper links to university logos
- Holly: usability scale questions responses can now be displayed individually

**Issues**
- after switching over the instance of the website we had to reupload our database and delete unusable entries after the move and recreate them
- azure was running slowly in the morning, just as it was set up

**Today's Tasks**
- Team completes final tests on the website
- Add more videos to the website as they were all lost during the switch
- Clean up all the database and remove test entries that are broken/no longer required

---
