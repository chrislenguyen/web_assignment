<?php
        include 'exam_controller.php';

        $res = $_REQUEST['function'];
        if ($res == "addQuestion") {
                $question = $_REQUEST['question'];
                $category = $_REQUEST['category'];
                $level = $_REQUEST['level'];
                $correct = $_REQUEST['correct'];

                $ansList = array();
                $ansList[0] = $_REQUEST['answer1'];
                $ansList[1] = $_REQUEST['answer2'];
                $ansList[2] = $_REQUEST['answer3'];

                $examController = new ExamController();
                $result = $examController->addQuestion ($question, $category, $level, $ansList, $correct);
                echo json_encode($result);

        } elseif ($res == "listQuestion") {
                $category = $_REQUEST['category'];
                $level = $_REQUEST['level'];
        
                $examController = new ExamController();
                $result = $examController->getQuestionList($category, $level);
                $questionList = array();
                for ($i = 0; $i < sizeof($result); $i++) {
                        $q_id = $result[$i]->getQuestionId();
                        $q_text = $result[$i]->getQuestionText();
                        $answerList = $result[$i]->getAnswerList();
                        $questionList[$i] = array("q_id"=>$q_id,
                                "q_text"=>$q_text,
                                "ans1"=>$answerList[0]->getAnswerText(),
                                "ans2"=>$answerList[1]->getAnswerText(),
                                "ans3"=>$answerList[2]->getAnswerText());
                }
				echo json_encode($questionList);
				
        } elseif ($res == "deleteQuestion") {
                $category = $_REQUEST['category'];
                $level = $_REQUEST['level'];
                $dataStr = $_REQUEST['q_id'];

				$result = -1;
				$start = 0;
				$end = 0;
				$pos = 0;
                $char = $dataStr[$pos];
                while ($char != "") {
                    if ($char == "-") {
						$end = $pos;
						$q_id = substr($dataStr, $start, ($end-$start));
						$start = $end + 1;
						$examController = new ExamController();
						$result = $examController->deleteQuestions($q_id);
						if ($result == false) {
							break;
						}
					} 
					$pos = $pos + 1;
					$char = $dataStr[$pos];
                }
                echo json_encode($result);
        } else {
                echo "guest";
        }
?>