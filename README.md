# MedicalClinic
Website Address: medicalgroup.azurewebsites.net
User authentication for different user roles: 

Admin:   

Username: admin 

Password: 1234 

Admin can see Clinic Revenue Report, Patient-Clinic Traffic Report, Biometrics. They can fill out the employee’s information to the database. Admin can add, delete, and edit the patient’s information. They can assign doctors for patients and make the billing for patients. 

 

Patient: 

Username: 1234609 

Password: 1234 

If you are a new patient, you can create your own account using the “create account” button in the login page. After you create your account, you can see the patient page. You can see the upcoming appointment, prescriptions and billing you must pay. You can also make the appointment with the doctor, clinic, and schedule time. 

 

Doctor 

Username: 342786 

Password: Salazar6758 

Users as doctors can refer the patient to different clinics or accept the referrals. Doctors can see their salary, appointment report, patient history, and referrals reports. They can also make a prescription for patients. 

 

Data Entry Form: 

Admin:   

The data was displayed in front end that the admin can keep track of employee’s information. Admin can also add new employee’s information as last name, first name, date of birth,… delete or update the information using Delete and Update button. They can also keep track of patients’ information, add, delete and update buttons are also available to use. 

 

Patient: 

As a patient, data entry form is the information that a new patient creates account when they want to sign to Medical Clinic page. They can also make appointments. Once a location is chosen, you will have the option to choose Doctors who work at that facility. Once the Doctor is chosen, the website will tell you what days he works on. If you choose a day, he does not work the website will stop the transaction and make you restart. If you choose the correct date, it will allow you to choose only times that are open. We decided to do 30-minute intervals where the clinics open at 8 A.M and end at 12 P.M.. You can request referrals, you’ll choose a doctor to send it to, be careful and make sure the doctor you send it to is assigned to you or else they won’t be able to see it (there is a table that shows which doctors are assigned to the patient that is logged in). There is also the ability to pay bills (The pay is make belief, but it does change how the admin report for clinic revenus is handled). There is also the upcoming tab which shows the upcoming appointments and the approved referrals.  

Doctor 

Doctor can add or delete the referrals at Referrals tab. This is done by choosing a patient assigned to you and then the receiving doctor If you choose yourself as the specialist it will tell you so on the next page if you continue when you select the date it will simply throw you back at the beginning. They can update, delete or add a prescription for patients at Prescription tab. This can only be done to patients assigned to the doctor logged in. They can view their salary, and the Appointment Report which shows all the appointments the doctor has. They can go deeper by going to Patient History, where they will choose a patient and view all their history with them. The referral report views all the referrals request that were sent to them, they can approve them if they wish. 

 

Triggers 

Trigger 1: The first trigger you will see under the referral table. This is simple: once you have opened two referrals that have been rejected or undecided, you cannot make a third. For this to work, the patient, doctor, and receiving doctor must be the same. At the third attempt an error message will appear telling you to call the doctor. 

To Trigger it, log in as username = 1234607 and password =1111. And try to make a referral with Salazar and builder as the doctor and receiving doctor. 

 

Trigger 2: This trigger stops patients with too many outstanding bills from continuing to make more appointments. The current limit is set at 5 and when reached the submit button will return an error informing them that they have too many bills to continue. 

 

To activate this trigger, follow the steps below: 

Username: 1234607 

Password: 1111 

Select “Appointments” on the top bar and input data as directed. When reaching the “Reason” a submit button will appear and upon pressing will inform the user that they have too many outstanding bills.  

 

 

 

 

Data Reports: 

1.Clinic Revenue Report is Where you can select the clinic, and the start date to end date and it will show the revenue that that clinic has generated. 

2.Patient Clinic Traffic is where you can select a clinic a doctor and the time range and it will tell you how many patients went in to see that doctor. 

3. Patient-Age Group is where you select the clinic and the lower bound and upper bound and date to see how many of those patients went in during those times. 
