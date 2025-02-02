function calculateAverage(data) {
    if (!data || data.length === 0) {
        return null;
    }
    const sum = data.reduce((acc, grade) => acc + grade, 0);
    const average = sum / data.length;
    return parseFloat(average.toFixed(2));
}

// Function to classify grades and generate a recommendation based on data
function gradeRangeRecommendation(subject, grade) {
    let recommendation = "";

    if (grade >= 95) {
        recommendation = `${subject}: Excellent performance, continue maintaining this level.`;
    } else if (grade >= 90) {
        recommendation = `${subject}: Great job, keep up the effort to maintain or improve.`;
    } else if (grade >= 85) {
        recommendation = `${subject}: Good work, but more focus on areas of improvement can help.`;
    } else if (grade >= 80) {
        recommendation = `${subject}: Decent performance, focus more on improving in this subject.`;
    } else if (grade >= 75) {
        recommendation = `${subject}: Room for improvement, review weak areas in ${subject}.`;
    } else {
        recommendation = `${subject}: Needs improvement, additional help may be required in ${subject}.`;
    }

    return recommendation;
}


function showRecommendation(firstQuarterData, secondQuarterData, thirdQuarterData, fourthQuarterData, subjects) {
    const recommendationContainer = document.getElementById('recommendationMessage');

    // If no subjects or data, show a fallback message
    if (!subjects || subjects.length === 0 || 
        !firstQuarterData || !secondQuarterData || !thirdQuarterData || !fourthQuarterData) {
        recommendationContainer.innerHTML = "Please select a section to see recommendations.";
        return;
    }

    // Helper function to find the subject with the lowest grade in each quarter
    function findWorstSubject(grades, subjects) {
        let worstSubjectIndex = 0;
        let lowestGrade = grades[0];

        for (let i = 1; i < grades.length; i++) {
            if (grades[i] < lowestGrade) {
                lowestGrade = grades[i];
                worstSubjectIndex = i;
            }
        }

        return { subject: subjects[worstSubjectIndex], grade: lowestGrade };
    }

    // Randomizer for phrases
    function getRandomPhrase(quarter, subject, grade) {
        const phrases = [
            `In the ${quarter}, ${subject} with a grade of ${grade}% requires more attention. Consider enhancing the teaching approach in this subject.`,
            `For the ${quarter}, focus on improving ${subject}, which scored ${grade}%. Additional resources could be helpful.`,
            `${subject} scored ${grade}% in the ${quarter}. It's an area to target for better performance.`,
            `During the ${quarter}, ${subject} was the weakest subject with a grade of ${grade}%. Encourage targeted reviews.`,
            `The ${quarter} results indicate that ${subject} needs more effort, with a grade of ${grade}%. A specialized plan could boost this score.`
        ];
        return phrases[Math.floor(Math.random() * phrases.length)];
    }

    // Generate recommendations for each quarter
    let recommendations = [];

    // 1st Quarter
    const firstQuarterWorst = findWorstSubject(firstQuarterData, subjects);
    recommendations.push(getRandomPhrase("1st Quarter", firstQuarterWorst.subject, firstQuarterWorst.grade));

    // 2nd Quarter
    const secondQuarterWorst = findWorstSubject(secondQuarterData, subjects);
    recommendations.push(getRandomPhrase("2nd Quarter", secondQuarterWorst.subject, secondQuarterWorst.grade));

    // 3rd Quarter
    const thirdQuarterWorst = findWorstSubject(thirdQuarterData, subjects);
    recommendations.push(getRandomPhrase("3rd Quarter", thirdQuarterWorst.subject, thirdQuarterWorst.grade));

    // 4th Quarter
    const fourthQuarterWorst = findWorstSubject(fourthQuarterData, subjects);
    recommendations.push(getRandomPhrase("4th Quarter", fourthQuarterWorst.subject, fourthQuarterWorst.grade));

    // Display all generated recommendations
    recommendationContainer.innerHTML = recommendations.join("<br><br>");
}


