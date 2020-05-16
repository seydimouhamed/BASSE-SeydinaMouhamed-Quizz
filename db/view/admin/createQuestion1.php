
		<link rel="stylesheet" type="text/css" href="public/css/styleCQ.css">
<div class="contain_pl">
	    <h2 class="h2">Parametrer votre question 2</h2>
	    <div class="contain_sub">
		        <form method="POST" id="mainform"action="index.php?origin=admin" onsubmit="return validate();" name="mainform" >
		            <div class="div_question">
		                <label>Questions</label>
                        <textarea name="question"  onkeyup='removeErrorTxt("error_1")' id="question" error='error_1'></textarea>
                        <small class="error" id='error_1'></small>
		            </div>
		            <div class="div_score">
		                <label>Nbr de point </label><input id="score" type="text" error='error_2' name="score" />
                        <small class="error" id='error_2'></small>
                    </div>
		            <div class="div_type">
		                <label>Type de reponse </label>
		                <select name="type" id="type" >
		                    <option value="cm">choix multiple</option>
		                    <option value="cs">choix simple</option>
		                    <option value="ct">choix text</option>
		                </select>
		                <span><input type="button" class="btn_gene"  id="btn_gene"  value="&nbsp;" ></span>
		            </div>
		            <br>
		            <span id="div_reponse" >
                    </span>
                    <small id="general_error" class="error"> </small>
		            <input type="submit" class="btn_enr" name="register_question" value="Enregistrer"/>
		        </form>
	    </div>
</div>


<script type="text/javascript" src="public/js/validationInput.js"></script>
<script type="text/javascript" src="public/js/validateQuestion.js"></script>
