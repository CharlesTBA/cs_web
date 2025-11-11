const grades = require('../data/grades.json');

module.exports = (express) => {
  const router = express.Router();

  router.get('/', (req, res) => {
    res.json(grades);
  });

  return router;
};
