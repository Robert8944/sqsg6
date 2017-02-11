package com.sqs.training.controller;

import java.sql.Statement;
import java.util.List;
import java.util.Map;

import org.hibernate.SQLQuery;
import org.hibernate.SessionFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestMapping;

import com.sqs.training.domain.EmailSub;
import com.sqs.training.domain.PhoneNumberSub;

@Controller
@Transactional
public class SubscriptionController {
	
	@Autowired
	SessionFactory sessionFactory;

	@RequestMapping("/subscribe")
	public String displaySubscriptionPage(Map<String, Object> model) {
		EmailSub emailForm = new EmailSub();
		model.put("emailForm", emailForm);
		databaseDebug(model);
		PhoneNumberSub phoneNumberForm = new PhoneNumberSub();
		model.put("phoneNumberForm", phoneNumberForm);
		return "subscribe";
	}
	
	@RequestMapping("/subscribeEmail")
	public String subscribeEmail(@ModelAttribute("emailForm") EmailSub emailForm,
			Map<String, Object> model) {
		try {
			Statement statement = sessionFactory.getCurrentSession().connection().createStatement();
			statement.executeQuery("insert into EMAIL_SUB (email) values ('" + emailForm.getEmail() + "')");
		} catch (Exception e) {
		}
		databaseDebug(model);
		EmailSub newEmailForm = new EmailSub();
		model.put("emailForm", newEmailForm);
		PhoneNumberSub newPhoneNumberForm = new PhoneNumberSub();
		model.put("phoneNumberForm", newPhoneNumberForm);
		return "subscribe";
	}
	
	@RequestMapping("/subscribePhoneNumber")
	public String subscribePhoneNumber(@ModelAttribute("phoneNumberForm") PhoneNumberSub phoneNumberForm,
			Map<String, Object> model) {
		SQLQuery query = sessionFactory.getCurrentSession().createSQLQuery("insert into PHONE_SUB (phone_number) values ('" + phoneNumberForm.getPhoneNumber() + "')");
		query.executeUpdate();
		databaseDebug(model);
		EmailSub newEmailForm = new EmailSub();
		model.put("emailForm", newEmailForm);
		PhoneNumberSub newPhoneNumberForm = new PhoneNumberSub();
		model.put("phoneNumberForm", newPhoneNumberForm);
		return "subscribe";
	}
	
	private void databaseDebug(Map<String, Object> model) {
		SQLQuery query = sessionFactory.getCurrentSession().createSQLQuery("select * from EMAIL_SUB");
		query.addEntity(EmailSub.class);
		List<EmailSub> emailSubs = query.list();
		model.put("emails", emailSubs);
		SQLQuery phoneQuery = sessionFactory.getCurrentSession().createSQLQuery("select * from PHONE_SUB");
		phoneQuery.addEntity(PhoneNumberSub.class);
		List<PhoneNumberSub> phoneSubs = phoneQuery.list();
		model.put("phoneNumbers", phoneSubs);
	}
}
