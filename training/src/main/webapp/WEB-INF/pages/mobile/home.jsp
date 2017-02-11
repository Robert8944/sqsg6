<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags"%>
<!DOCTYPE html>
<html>
<head>
	<spring:url value="/resources/css/mobile/base.css" var="baseCss" />
	<spring:url value="/resources/css/home.css" var="homeCss" />

	<link rel="stylesheet" type="text/css" href="${baseCss}" />
	<link rel="stylesheet" type="text/css" href="${homeCss}" />

	<title>SQS Training - Home</title>
</head>
<body>
	<div id="mainContainer" class="main-container">
		<%@include file='toolbar.jsp'%>
		<%@include file='header.jsp'%>
		<div id="contentContainer" class="content-container column-container med-font">
			<div id="textContainer" class="text-container column-container">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultrices elit eu mauris mollis mattis. Quisque id neque placerat, maximus magna pharetra, aliquet libero. Proin elit tortor, ullamcorper vel elementum eu, blandit sed augue. Donec sit amet feugiat tortor. Nunc tincidunt dui magna, eu tempus tortor venenatis sit amet. Suspendisse ultricies tortor in eros mattis, at vestibulum lacus bibendum.
			</div>
			<hr>
			<div id="subscribeContainer" class="subscribe-container column-container">
				<div id="subscribePrompt" class="column-container">
					Keep up to date,
				</div>
				<button onclick="location.href = 'subscribe';" id="subscribeLink" class="raised-button column-container med-font">Sign up for email and text info</button>
			</div>
		</div>
	</div>
</body>
</html>