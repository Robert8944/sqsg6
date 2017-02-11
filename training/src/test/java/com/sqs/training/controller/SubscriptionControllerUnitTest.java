package com.sqs.training.controller;

import static org.hamcrest.CoreMatchers.equalTo;
import static org.junit.Assert.assertThat;

import java.util.HashMap;
import java.util.Map;

import org.hibernate.Criteria;
import org.hibernate.SessionFactory;
import org.hibernate.criterion.Example;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.transaction.annotation.Transactional;

import com.sqs.training.domain.EmailSub;
import com.sqs.training.domain.PhoneNumberSub;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration("classpath:context-test.xml")
public class SubscriptionControllerUnitTest {
	
	private String correctReturnSubscribePage = "subscribe";
	private String emailFormModelAttribute = "emailForm";
	private String phoneNumberFormModelAttribute = "phoneNumberForm";
	private String testEmail = "testemail@email.com";
	private String testPhoneNumber = "111-111-1111";
	
	@Autowired
	private SubscriptionController subscriptionController;
	
	@Autowired
	private SessionFactory sessionFactory;

	@Test
	public void testDisplaySubscriptionPage() {
		Map<String, Object> model = new HashMap<String, Object>();
		String retValue = subscriptionController.displaySubscriptionPage(model);
		assertThat(((EmailSub) model.get(emailFormModelAttribute)).equals(new EmailSub()), equalTo(true));
		assertThat(((PhoneNumberSub) model.get(phoneNumberFormModelAttribute)).equals(new PhoneNumberSub()), equalTo(true));
		assertThat(retValue, equalTo(correctReturnSubscribePage));
	}
	
	@Test
	@Transactional
	public void testSubscribeEmail() {
		Map<String, Object> model = new HashMap<String, Object>();
		EmailSub emailForm = new EmailSub();
		emailForm.setEmail(testEmail);
		String retValue = subscriptionController.subscribeEmail(emailForm, model);
		Criteria criteria = sessionFactory.getCurrentSession().createCriteria(emailForm.getClass());
		Example example = Example.create(emailForm);
		criteria.add(example);
		EmailSub savedEmailSub = (EmailSub) criteria.uniqueResult();
		savedEmailSub.setId(null);
		assertThat(savedEmailSub.equals(emailForm), equalTo(true));
		assertThat(retValue, equalTo(correctReturnSubscribePage));
	}
	
	@Test
	@Transactional
	public void testSubscribePhoneNumber() {
		Map<String, Object> model = new HashMap<String, Object>();
		PhoneNumberSub phonenumberForm = new PhoneNumberSub();
		phonenumberForm.setPhoneNumber(testPhoneNumber);
		String retValue = subscriptionController.subscribePhoneNumber(phonenumberForm, model);
		Criteria criteria = sessionFactory.getCurrentSession().createCriteria(phonenumberForm.getClass());
		Example example = Example.create(phonenumberForm);
		criteria.add(example);
		PhoneNumberSub savedPhoneNumberSub = (PhoneNumberSub) criteria.uniqueResult();
		savedPhoneNumberSub.setId(null);
		assertThat(savedPhoneNumberSub.equals(phonenumberForm), equalTo(true));
		assertThat(retValue, equalTo(correctReturnSubscribePage));
	}

}
