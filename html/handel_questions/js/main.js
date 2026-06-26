let callCount = 1;
const maxCalls = 4;

function createAnswerDiv(s) {
  const container = document.getElementById(`answersContainer${s}`);
  callCount = container.childElementCount;
  if (callCount >= maxCalls) {
    return;
  }
  callCount++;
  // Create a div element with class "answer"
  const answerDiv = document.createElement("div");
  answerDiv.classList.add("answer-box");

  const deleteButton = document.createElement("button");
  deleteButton.classList.add("delete-btn");
  deleteButton.innerHTML = '<i class="fa-regular fa-square-minus fs-4"></i>';
  deleteButton.addEventListener("click", () => {
    answerDiv.remove(); // Remove the entire answerDiv
    callCount--; // Decrement the counter
  });
  // Create an input field of type "text"
  const inputField = document.createElement("input");
  inputField.type = "text";
  inputField.name = `answer${s}${callCount}`;
  inputField.placeholder = "Enter Answer";
  inputField.classList.add("in-answer");

  const radioButton = document.createElement("input");
  radioButton.type = "radio";
  radioButton.classList.add("CorrectAnswerBtn");
  radioButton.name = `correctAnswer${s}`; // All radio buttons have the same name
  radioButton.value = `${callCount}`;

  // Append the input field to the div
  answerDiv.appendChild(deleteButton);
  answerDiv.appendChild(inputField);
  answerDiv.appendChild(radioButton);
  // Append the div to the container
  container.appendChild(answerDiv);
}