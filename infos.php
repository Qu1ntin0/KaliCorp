<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'
rel='stylesheet'> 
  <link rel="stylesheet" href="style4.css">
  
  <title>User Data</title>
</head>
<body>
<h1></h1>
  
<form action="salvar_dados.php" method="POST">
    <p>
    <label>
         <i class='bx bx-calendar-alt' ></i>  Idade
      <input type="text" name="idade">
    </label>
    </p>
    <p> 
    <label>
      <i class='bx bx-dumbbell' ></i> Peso
      <input type="text" name="peso">
    </label>
    </p>
    <p>
    <label>
      <i class='bx bx-ruler' ></i> Altura
      <input type="text" name="altura">
    </label>
    </p>
    <p>
    <label style="display: flex; align-items: center; gap: 10px;">
      <i class='bx bx-rugby-ball'></i>
    <span>Sexo:</span>
      <select name="Sexo" style="width: 230px; padding: 5px;">
        <option value="homem">Homem</option>
        <option value="mulher">Mulher</option>
      </select>
    </label>
    </p>
    <p>
    <button type="submit">Save</button>
    </p>
</form>

</body>
</html>