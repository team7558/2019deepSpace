/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.PIDSubsystem;
import com.revrobotics.CANEncoder;
import com.revrobotics.CANSparkMax;

public class PIDMotorJoint extends PIDSubsystem {
  private double m_encoderPerAngle, m_zeroEncoder, m_targetAngle, m_maxAngle;
  private CANSparkMax m_jointMotor;
  private CANEncoder m_jointEncoder;
  
  public PIDMotorJoint(String subsystemName, CANSparkMax jointMotor, double encoderPerAngle, double maxAngle, double kP, double kD, double kI) {
    
    super(subsystemName, kP, kD, kI);

    m_jointMotor = jointMotor;
    m_jointEncoder = new CANEncoder(m_jointMotor);
    m_encoderPerAngle = encoderPerAngle;
    m_maxAngle = maxAngle;

    m_maxAngle = 0;
    m_zeroEncoder = 0;
    m_encoderPerAngle = 1;

    setSetpoint(0);
    enable();
  }

  public void resetAngle(){
    m_zeroEncoder = m_jointEncoder.getPosition();
    setSetpoint(0);
  }

  public double getAngle(){
    return -(m_jointEncoder.getPosition()-m_zeroEncoder)/m_encoderPerAngle;
  }

  @Override
  protected void initDefaultCommand() {
    
  }

  @Override
  protected double returnPIDInput() {
    return getAngle();
  }

  @Override
  protected void usePIDOutput(double output) {
    if (getAngle() < 0){
      setSetpoint(0);
    } else if (getAngle() > m_maxAngle){
      setSetpoint(m_maxAngle);
    } else {
      m_jointMotor.set(output);
    }
  }

  public void setAngle(double targetAngle){
    if (targetAngle <= m_maxAngle && targetAngle >= 0){
      m_targetAngle = targetAngle;
    }
    setSetpoint(m_targetAngle);
  }
}
